function print_canvas(){
    const element = document.getElementById('contenido');
    /*html2pdf().set({
        margin:       0,
        filename:     'certificado.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    }).from(element).save().catch(error=>console.log(error));*/

    html2pdf().set({
      margin:       1,
      filename:     'certificado.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 3 },
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    }).from(element).save().catch(error=>console.log(error));
}

function imprimir_boleta(){

        const element = document.getElementById('contenido_liqui');
        /*html2pdf().set({
            margin:       0,
            filename:     'certificado.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        }).from(element).save().catch(error=>console.log(error));*/
    
        html2pdf().set({
          margin:       10,
          filename:     'liquidacion.pdf',
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { scale: 3 },
          jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        }).from(element).save().catch(error=>console.log(error));
    
}

function imprimir_liquidacion(){
    const element1 = document.getElementById('contenido_liqui');

    html2pdf().set({
      margin:       [-4,0,0,0],
      filename:     'liquidacion.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 3, letterRendering: true },
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    }).from(element1).save().catch(error=>console.log(error));

    /*html2canvas(document.getElementById('contenido_liqui')).then(function (canvas) {
        document.body.appendChild(canvas);
        var imgdata = canvas.toDataURL("image/jpg");
        var doc = new jspdf.jsPDF();
        //doc.addImage(imageData, format, x, y, width, height, alias, compression, rotation)
        doc.addImage(imgdata, "JPG", 30, 30);
        doc.save("liquidacion.pdf");
    });*/
}