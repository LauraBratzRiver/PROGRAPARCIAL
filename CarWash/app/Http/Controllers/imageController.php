
public function store(Request $request)
{
    if ($request->hasFilemove('images'){
        $path = $request->image->store('public');
        Image::create(['path' => $path]);

    }

}