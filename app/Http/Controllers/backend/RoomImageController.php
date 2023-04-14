<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\RoomImage;

class RoomImageController extends Controller
{
    public function destroy(Request $request)
    {
        $item_id = $request->input('id');
        $item = RoomImage::find($item_id);
        $image = $item->image;

        if ($item) {
            $delete = $item->where('id', $item_id)->where('main', '!=', 1)->delete();
            if ($delete and File::exists(public_path('uploads/rooms/' . $image))) {
                File::delete(public_path('uploads/rooms/' . $image));
                return response()->json(['success' => true, 'message' => "Image deleted successfully"]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "The main image cannot be deleted. You can continue the deletion process after choosing another image as the main image before you see the deletion process"
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item not found'
            ]);
        }
    }

}
