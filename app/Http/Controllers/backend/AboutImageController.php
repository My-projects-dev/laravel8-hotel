<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutImageController extends Controller
{
    public function destroy(Request $request)
    {
        $item_id = $request->input('id');
        $item = AboutImage::find($item_id);
        $image = $item->image;

        if ($item) {
            if (File::exists(public_path('uploads/abouts/' . $image))) {
                File::delete(public_path('uploads/abouts/' . $image));
                $item->delete();
                return response()->json(['success' => true, 'message' => "Image deleted successfully"]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "The image could not be deleted"
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
