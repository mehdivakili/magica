<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AdminController extends Controller
{
    public function get_file(Request $request)
    {
        return Storage::download($request->input('link'));
    }

    public function get_file_with_link($link)
    {
        return Storage::download($link);
    }

    public function set_file(Request $request, bool $withName = false)
    {
        if (!$withName) {
            Storage::put($request->input('link'), $request->file('picture'));
        }else
            Storage::put($request->input('link'), file_get_contents($request->file('picture')));
        return redirect()->back();
    }

    public function export_one(Order $order)
    {

        $excel = '';
        $data = [];
        $instance['code'] = $order->id . "_". str_replace(" ", "-", $order->name)."_". str_replace(" ", "-", $order->user->name);
        $has_file = false;
        $is_first = true;
        $zip = null;

        $name = Carbon::now() . str_replace(' ','_',$order->name) . '.zip';

        foreach ($order->answers as $answer){
            $question = $answer->question;
            if ($question->type == 'file') {
                if(empty($answer->value)){
                    $instance[$question->name] ='XXX.jpg';
                }else{

                    if($is_first){
                        $zip = new ZipArchive();
                        $has_file = true;
                        $is_first = false;
                    }
                    $ext = pathinfo(storage_path() . '/' . $answer->value, PATHINFO_EXTENSION);
                    if ($zip->open('../export.zip', ZipArchive::CREATE) === TRUE) {

                        $zip->addFromString($instance['code'] . '_' . $question->name . '.' . $ext, Storage::get($answer->value));

                    }
                    $instance[$question->name] = $instance['code'] . '_' . $question->name . '.' . $ext;
                }


            } else {
                $instance[$question->name] = empty($answer->value)?'XXX':$answer->value;
            }
        }
        $data[] = $instance;

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display field/column names as first row
                $excel .= implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            $excel .= implode("\t", array_values($row)) . "\r\n";
        }

        if ($order->status == 'not completed') {
            $order->status = "in completed";
            $order->save();
        }

        if ($has_file) {

            $zip->addFromString('info.txt', $excel);
            $zip->close();
            return response()->download('../export.zip', $name)->deleteFileAfterSend();
        } else {
            return response($excel, 200)->header('Content-Type', 'text/plain');
        }

    }

    public function import_one(Request $request, Order $order)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if (Storage::put('images/' . $order->user_id . '/' . $order->id . '.' . $file->getClientOriginalExtension(), file_get_contents($file))) {
                $order->order_image = 'images/' . $order->user_id . '/' . $order->id . '.' . $file->getClientOriginalExtension();
                $order->status = 'completed';
                $order->save();
            }


        }
        return redirect()->back()->with([
            'message' => 'imported successfully',
            'alert-type' => 'success'
        ]);
    }

    public function export(Category $category, Order $order_one = null)
    {
        $excel = '';
        $instance = [];
        $data = [];
        $instance['code'] = 'XXX';
        $has_file = false;
        $is_first = true;
        $zip = null;

        $name = Carbon::now() . $category->slug . '.zip';
        //dd($name);
        foreach ($category->arts as $art)
            foreach ($art->questions as $question)
                if ($question->type == 'file') {
                    $instance[$question->name] = 'XXX.jpg';

                } else {
                    $instance[$question->name] = 'XXX';
                }
        foreach ($category->arts as $art) {
            $instance[$art->name] = 'FALSE';
        }

        if ($order_one === null) {

            $orders = $category->orders()->where(function ($query) {
                $query->where('status', '=', 'not completed')->OrWhere('status', '=', 'in completed');
            })->get();

        } else {
            $orders = [$order_one];
        }


        foreach ($orders as $order) {
            $cp = $instance;
            $cp['code'] = $order->id . "_" . $order->art->name . "_" . str_replace(" ", "_", $order->user->name);

            foreach ($order->answers as $answer) {
                if ($answer->question->type === 'file') {

                    if ($is_first) {

                        $zip = new ZipArchive();
                        $has_file = true;
                        $is_first = false;

                    }

                    $ext = pathinfo(storage_path() . '/' . $answer->value, PATHINFO_EXTENSION);

                    if ($zip->open('../export.zip', ZipArchive::CREATE) === TRUE) {

                        $zip->addFromString($cp['code'] . '_' . $answer->question->name . '.' . $ext, Storage::get($answer->value));

                    }
                    $cp[$answer->question->name] = $cp['code'] . '_' . $answer->question->name . '.' . $ext;
                } else
                    $cp[$answer->question->name] = $answer->value;
            }
            $cp[$order->art->name] = 'TRUE';
            if ($order->status == 'not completed') {
                $order->status = "in completed";
                $order->save();
            }
            $data[] = $cp;

        }


        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display field/column names as first row
                $excel .= implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            $excel .= implode("\t", array_values($row)) . "\r\n";
        }

        if ($has_file) {

            $zip->addFromString('info.txt', $excel);
            $zip->close();
            return response()->download('../export.zip', $name)->deleteFileAfterSend();
        } else {
            return response($excel, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function import(Request $request)
    {
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {

                $order_id = explode("_", $file->getClientOriginalName(), 2)[0];
                $order = Order::findOrFail($order_id);
                if (Storage::put('images/' . $order->user_id . '/' . $order->id . '.' . $file->getClientOriginalExtension(), file_get_contents($file))) {
                    $order->order_image = 'images/' . $order->user_id . '/' . $order->id . '.' . $file->getClientOriginalExtension();
                    $order->status = 'completed';
                    $order->save();
                }

            }
        }
        return redirect()->back()->with([
            'message' => 'imported successfully',
            'alert-type' => 'success'
        ]);
    }


}
