<?php

namespace App\Http\Controllers;

use App\Models\PermissionService;
use App\Models\Product;
use App\Models\ProductSection;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductSectionController extends Controller
{
    protected $perGate;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                $this->perGate = PermissionService::checkPermission($user, 'CRUD_product');
                Gate::authorize('has-permision', $this->perGate);
            } else {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    public function index($id)
    {
        $product = Product::find($id);
        return view('productSection.index',compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $product = Product::find($id);
        return view('productSection.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,$id)
    {
        $product = Product::find($id);
        $section = $request->section;

        $dom = new DOMDocument();
        $dom->loadHTML($section,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);
            $image_name2 = "http://127.0.0.1:8000/upload/" . time(). $key.'.png';
            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name2);
        }
        $section = $dom->saveHTML();

        ProductSection::create([
            'product_id' => $product->id,
            'nameOfSection' => $request->name,
            'section' => $section
        ]);

        return redirect()->route('section.index',$product->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = ProductSection::find($id);
        return view('productSection.show',compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $section = ProductSection::find($id);
        return view('productSection.update',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productSection = ProductSection::find($id);

        $section = $request->section;

        $dom = new DOMDocument();
        $dom->loadHTML($section,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            if (strpos($img->getAttribute('src'),'data:image/') ===0) {

                $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time(). $key.'.png';
                file_put_contents(public_path().$image_name,$data);
                $image_name2 = "http://127.0.0.1:8000/upload/" . time(). $key.'.png';
                $img->removeAttribute('src');
                $img->setAttribute('src',$image_name2);
            }

        }
        $section = $dom->saveHTML();
        $productSection->update([
            'nameOfSection' => $request->name,
            'section' => $section
        ]);
        return redirect()->route('section.index',$productSection->product_id);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productSection = ProductSection::find($id);

        $dom= new DOMDocument();
        $dom->loadHTML($productSection->section,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');


            if (File::exists($path)) {
                File::delete($path);

            }
        }

        $productSection->delete();
        return redirect()->back();

    }
}
