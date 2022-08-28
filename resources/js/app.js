import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.jpg,.png,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: "Borrar imagen",
    maxFiles: 1,
    uploadMultiple: false,

    init:function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
        }
    }
})
dropzone.on('success', (file,response)=>{
    console.log(response);
    document.querySelector('[name="imagen"]').value = response.imagen;
})

dropzone.on('error', (file, message)=>{
    console.log(message);
})

dropzone.on('removedfile', (file)=>{
    document.querySelector('[name="imagen"]').value = "";
})

