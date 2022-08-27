import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: "Borrar imagen",
    maxFiles: 1,
    uploadMultiple: false
})
dropzone.on('success', (file,response)=>{
    console.log(response);
})

dropzone.on('error', (file, message)=>{
    console.log(message);
})