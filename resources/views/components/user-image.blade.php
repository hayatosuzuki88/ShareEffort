<div x-data="imagePreview()">
    <input @change="showPreview(event)" type="file" id="image_path" name="image_path">
    <img src="{{ isset(Auth::user()->image_path) ? asset('storage/' . Auth::user()->image_path) : asset('images/no-image.png') }}" alt="" id="preview">

    <script>
        function imagePreview(){
            return {
                showPreview: (event) => {
                    if (event.target.files.length > 0){
                        var src = URL.createObjectURL(event.target.files[0]);
                        document.getElementById('preview').src = src;
                    }
                }
            }
        }
    </script>
</div>