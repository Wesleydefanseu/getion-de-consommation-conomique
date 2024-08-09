@if (Auth::user()->usertype=='seller')


<div class="container" style="background:#FF8000;">
    <form method="post" action="{{ route('seller.photo.boutique') }}" enctype="multipart/form-data">
        @csrf
        <div style="background-color:darkgoldenrod" id="add-photo-btn">Ajouter une Photo</div>
        <div id="photos-container">

        </div>
        <button style="background-color:burlywood;margin-top:50px;" type="submit">Enregistrer</button>
    </form>

</div>
@endif

<script type="text/javascript">
    function deleteDiv(idDiv) {
        const photosContainer = document.getElementById('photos-container');
        const photoSection = document.getElementById(idDiv);
        photosContainer.removeChild(photoSection);
    }

    function changeTof(event, idImg) {

        const fileInput = event.target;
        const previewImage = document.getElementById(idImg);
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

    }
</script>