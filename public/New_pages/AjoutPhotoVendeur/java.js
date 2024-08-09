document.addEventListener('DOMContentLoaded', function() {
    const addPhotoBtn = document.getElementById('add-photo-btn');
    const photosContainer = document.getElementById('photos-container');

    let photoIndex = 0;

    addPhotoBtn.addEventListener('click', function() {
        const photoSection = document.createElement('div');
        photoSection.classList.add('photo-section');

        const input = document.createElement('input');
        input.type = 'file';
        input.name = `photoInit[]`;
        input.accept = 'image/*';

        const img = document.createElement('img');
        img.src = '#'; // Placeholder for image

        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.textContent = 'Supprimer';

        deleteBtn.addEventListener('click', function() {
            photosContainer.removeChild(photoSection);
        });

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        photoSection.appendChild(input);
        photoSection.appendChild(img);
        photoSection.appendChild(deleteBtn);

        photosContainer.appendChild(photoSection);

        photoIndex++;
    });


 
});

