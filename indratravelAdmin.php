<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .acoeo-button .dashicons {
        vertical-align: middle;
    }

    .dialog {
        position: fixed;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 999999;
        background-color: rgba(255, 255, 255, .75);
        width: 100%;
        height: 100%;
        display: none;
    }

    .dialog.active {
        display: block;
    }

    #acoeoDialog form {
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #acoeoDialog fieldset {
        padding: 2rem;
        box-shadow: 0 .5rem .75rem rgba(0 , 113, 161,.25);
        border-radius: .5rem;
        background-color: #fff;
    }

    #acoeoDialog leyend {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
        display: block;
    }

    #acoeoDialog .acoeo-field-list {
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }


    @media (min-width: 700px) {
        #acoeoDialog .acoeo-field-list {
            max-width: calc(400px + 4rem);
        }
    }

    #acoeoDialog .acoeo-field-list li {
        max-width: calc(80vw - 2rem);
        margin-bottom: 1rem;
        width: 100%;
        padding: 0 1rem;
    }

    @media (min-width: 700px) {
        #acoeoDialog .acoeo-field-list li {
            max-width: 200px;
            width: 50%;
        }
    }

    #acoeoDialog .acoeo-field-list li.full-row {
        width: 100%;
        max-width: 100%;
    }

    #acoeoDialog .acoeo-field-list input:not([type="checkbox"]),
    #acoeoDialog .acoeo-field-list textarea {
        width: 100%;
        resize: none;
    }

    #acoeoDialog .acoeo-field-list .full-row input:not([type="checkbox"]),
    #acoeoDialog .acoeo-field-list .full-row textarea {
        width: 100%
    }

    #acoeoDialog .acoeo-field-list .acoeo-dialog-buttons {
        width: 100%;
        max-width: 100%;
        text-align: right;
        margin: 0;
    }

    .button.clean-button,
    .button.clean-button:hover {
        border-color: transparent;
        background-color: transparent;
    }

    .hidden-input {
        display: none;
    }

    #acoeoTableParthner img {
        width: 100%;
        max-width: 50px;
    }

    #acoeoUpdates.active {
        padding: 5px 1rem 7px;
        background-color: #00b894;
        color: #fff;
        border-radius: .25rem;
        margin-right: 20px;
    }
    </style>
</head>



<body>
    <div class="row">
        <div class="col s12">
            <h2><?php echo esc_html(get_admin_page_title())?></h2>
        </div>
    </div>
    <main class="tabs">
      <head>
        <button class="button_tabs">Paquetes</button>
        <button class="button_tabs">Paises</button>
        <button class="button_tabs">Ciudades</button>
        <button class="button_tabs">Imagenes</button>
      </head>
    </main>
    <!-- <div class="tablenav top">
        <div id="acoeoUpdates"></div>
    </div> -->
    <div class="tablenav top">
        <button class="button button-primary acoeo-button" id="acoeoAddParthner">
            <span class="dashicons dashicons-plus"></span>
            Agregar asociado
        </button>
    </div>
    <div class="wrap">
        <table class="wp-list-table widefat fixed striped">
            <colgroup>
                <col style="visibility: collapse">
                <col style="width: 14.5%; max-width: 200px;">
                <col style="width: 14.5%; max-width: 150px;">
                <col style="width: 14.5%; max-width: 100px;">
                <col style="width: 20%; max-width: 400px;">
                <col style="width: 30%; max-width: 400px;">
                <col style="width: 14.5%; max-width: 200px;">
                <col style="width: 14.5%; max-width: 200px;">
                <col style="width: 14.5%; max-width: 200px;">
                <col style="width: 14.5%; max-width: 200px;">
            </colgroup>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre comercial</th>
                    <th>Nombre fiscal</th>
                    <th>Correo electrónico</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Númer de asociado</th>
                    <th>Imagen</th>
                    <th>Activo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="acoeoTableParthner">
            </tbody>
        </table>
    </div>
    <section id="acoeoDialog" class="dialog">
        <form method="post" id="acoeoFormSave" enctype="multipart/form-data">
            <fieldset>
                <leyend id="acoeoDialogTitle"></leyend>
                <ul class="acoeo-field-list">
                    <li class="hidden-input">
                        <input type="text" id="id" placeholder="id" name="id">
                    </li>
                    <li>
                        <label for="nombre">Nombre comercial</label><br>
                        <input type="text" id="nombre" placeholder="Nombre comercial" name="nombre" required>
                    </li>
                    <li>
                        <label for="correo">Correo electrónico</label><br>
                        <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
                    </li>
                    <li class="full-row">
                        <label for="descripcion">Nombre fiscal</label><br>
                        <textarea name="descripcion" id="descripcion" placeholder="Nombre fiscal" required></textarea>
                    </li>
                    <li class="full-row">
                        <label for="direccion">Dirección</label><br>
                        <textarea name="direccion" id="direccion" placeholder="Dirección" required></textarea>
                    </li>
                    <li>
                        <label for="numero">Número del asociado</label><br>
                        <input type="number" id="numero" placeholder="Número de asociado" name="numero" required>
                    </li>
                    <li>
                        <label for="telefono">Teléfono</label><br>
                        <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" required>
                    </li>
                    <li class="full-row">
                        <label for="activo">Estatus del asociado</label><br>
                        Activo: <input type="checkbox" name="activo" id="activo" value="1">
                    </li>
                    <li>
                    <label for="telefono">Logotipo</label><br>
                        <input type="file" name="imagen" id="imagen" onchange="previewFile()" accept="image/jpeg" />
                    </li>
                    <li>
                        <img src="" height="75" alt="Image preview..." id="acoeoPreviewLogo">
                    </li>
                    <li id="acoeoErrorMessage"></li>
                    <li class="acoeo-dialog-buttons">
                        <button type="button" id="acoeoCloseDialog" class="button clean-button">Cancelar</button>
                        <button type="reset" id="acoeoReset" name="reset" class="button action">Limpiar</button>
                        <button type="submit" value="Guardar" id="acoeoGuardar" name="guardar" class="button button-primary acoeo-button">Guardar</button>
                    </li>
                </ul>
            </fieldset>
        </form>
    </section>
    <script>
      let selectedTab = 0;
      const buttonTabs = document.querySelectorAll('.button_tabs');



        let popUpState = "";
        function acoeoPopup(bool) {
            popUpState = bool ? "guardar" : "actualizar";
            document.querySelector("#acoeoDialogTitle").innerHTML = bool ? "Nuevo asociado" : "Editar asociado";
            document.querySelector("#acoeoDialog").classList.add("active");
            if(bool) {
                document.querySelector("#correo").disabled = false;
                document.querySelector("#numero").disabled = false;
            } else {
                document.querySelector("#correo").disabled = true;
                document.querySelector("#numero").disabled = true;
            }
        }

        function previewFile() {
            const preview = document.querySelector('#acoeoPreviewLogo');
            const file = document.querySelector('#imagen').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file && file.type === "image/jpeg" && file.size < 512000) {
                reader.readAsDataURL(file);
                document.querySelector("#acoeoErrorMessage").innerHTML = "";
            } else {
                document.querySelector('#imagen').value = "";
                document.querySelector("#acoeoErrorMessage").innerHTML = "La imagen debe pesar menos de 512KB y debe ser de formato JPG";
            }
        }

        function closePopUp() {
            let nodes = document.querySelector("#acoeoDialog").querySelectorAll("input, textarea");
            document.querySelector("#acoeoDialog").classList.remove("active");
            for(let i = 0; i < nodes.length; i++) {
                if(nodes[i].name === "activo") {
                    nodes[i].checked = false;
                } else {
                    nodes[i].value = "";
                }
            }
            document.querySelector("#acoeoPreviewLogo").src = "";
        }

        function sendData(event) {
            event.preventDefault();
            if( !acoeoFileName.binary && acoeoFileName.dom.files.length) {
                setTimeout( sendData, 10 );
                return;
            }
            const url = popUpState === "guardar" ? '<?php echo plugins_url('guardarAsociado.php', __FILE__) ?>' : '<?php echo plugins_url('actualizarAsociado.php', __FILE__) ?>';
            let data = new FormData(),
                nodes = event.currentTarget.querySelectorAll("input, textarea, button[type='submit']");

            if (popUpState === "guardar") {
                for(let i = 0; i < nodes.length; i++) {
                    if (nodes[i].name !== "imagen") {
                        if(nodes[i].name === "activo") {
                            data.append(nodes[i].name, nodes[i].checked ? 1 : 0);
                        } else {
                            data.append(nodes[i].name, nodes[i].value);
                        }
                    } else {
                        data.append(nodes[i].name, nodes[i].files[0]);
                    }
                }
            } else {
                for(let i = 0; i < nodes.length; i++) {
                    if (nodes[i].name !== "imagen") {
                        if(nodes[i].name === "activo") {
                            data.append(nodes[i].name, nodes[i].checked ? 1 : 0);
                        } else {
                            data.append(nodes[i].name, nodes[i].value);
                        }
                    } else {
                        if(nodes[i].value) {
                            data.append(nodes[i].name, nodes[i].files[0]);
                        } else {
                            let name = document.querySelector("#acoeoPreviewLogo").src.split("/").pop();
                            name = name.substring(0, name.indexOf("?v="));
                            data.append("imagen", name);

                        }
                    }
                }
                data.append("actualizar", "actualizar");
            }

            fetch(url, {
                method: "POST",
                body: data
            }).then((response) => {
                return response.json();
            }).then((newJson) => {
                if (newJson.codigo === 200) {
                    closePopUp();
                    acoeoRenderParthners();
                    msgBanner(newJson.mensaje);
                } else {
                    document.querySelector("#acoeoErrorMessage").innerHTML = newJson.mensaje;
                }
            });
        }

        function msgBanner(text) {
            node = document.querySelector("#acoeoUpdates");
            node.innerHTML = text;
            node.classList.add("active");
        }

        function acoeoRenderParthners() {
            const XHR = new XMLHttpRequest();
            let urlEncodedData = "",
                urlEncodedDataPairs = [],
                timeStamp = new Date();

            for(let i = 0; i < 1; i++) {
                urlEncodedDataPairs.push(`consultar=consultar`);
            }
            urlEncodedData = urlEncodedDataPairs.join( '&' ).replace( /%20/g, '+' );
            XHR.addEventListener("load", transferComplete);
            function transferComplete(evt) {
                console.log(evt)
                let responseAPI = JSON.parse(evt.target.response),
                    template = "";
                for (let index = 0; index < responseAPI.length; index++) {
                    template += `<tr>
                    <td>${responseAPI[index].ID}</td>
                    <td>${responseAPI[index].NOMBRE}</td>
                    <td>${responseAPI[index].DESCRIPCION}</td>
                    <td>${responseAPI[index].CORREO}</td>
                    <td>${responseAPI[index].TELEFONO}</td>
                    <td>${responseAPI[index].DIRECCION}</td>
                    <td>${responseAPI[index].NUMERO}</td>
                    <td><img src="${window.location.origin + window.location.pathname.replace("wp-admin/admin.php", "")}wp-content/plugins/asociadosACOEO/adjuntos/${responseAPI[index].IMAGEN}?v=${timeStamp.getTime()}" alt="${responseAPI[index].NOMBRE}"></td>
                    <td>${responseAPI[index].ACTIVO === "1" ? "Sí" : "No"}</td>
                    <td>
                        <button class="button action acoeo-edit-parthner">Editar</button>
                        <button class="button clean-button acoeo-delete-parthner">Eliminar</button>
                    </td>
                </tr>`;
                }
                document.querySelector("#acoeoTableParthner").innerHTML = template;
            }
            XHR.open( 'POST', '<?php echo plugins_url('consultarAsociados.php', __FILE__) ?>', true );
            XHR.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            XHR.send( urlEncodedData );
        }

        function acoeoEditBtn(e) {
            if (e.target.classList.contains("acoeo-edit-parthner")) {
                let nodes = e.target.parentElement.parentElement.children;
                    attributesName = [
                    "id",
                    "nombre",
                    "descripcion",
                    "correo",
                    "telefono",
                    "direccion",
                    "numero",
                    "imagen",
                    "activo",
                    "actualizar"
                ];
                for(let i = 0; i < nodes.length; i++) {
                    if (i === 7) {
                        document.querySelector("#" + attributesName[i]).value = "";
                        document.querySelector("#acoeoPreviewLogo").src = nodes[i].children[0].src;
                    } else if(i < 7) {
                        document.querySelector("#" + attributesName[i]).value = nodes[i].innerHTML;
                    } else  if(i === 8){
                        document.querySelector("#activo").checked = nodes[i].innerHTML === "Sí" ? true : false;
                    }
                }
                acoeoPopup(false);
            } else if (e.target.classList.contains("acoeo-delete-parthner")) {
                const url = '<?php echo plugins_url('eliminarAsociado.php', __FILE__) ?>';
                let data = new FormData();

                data.append("id", e.target.parentElement.parentElement.children[0].innerHTML);
                data.append("eliminar", "");
                let name = e.target.parentElement.parentElement.children[7].children[0].src.split("/").pop();
                name = name.substring(0, name.indexOf("?v="));
                data.append("imagen", name);

                fetch(url, {
                    method: "POST",
                    body: data
                }).then((response) => {
                    return response.json();
                }).then((newJson) => {
                    if (newJson.codigo === 200) {
                        acoeoRenderParthners();
                        msgBanner("El asociado se ha eliminado")
                    } else {
                        alert(newJson.mensaje);
                    }
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            window.acoeoFileName = {
                dom : document.getElementById( "imagen" ),
                binary : null
            }

            window.uploadReader = new FileReader();

            uploadReader.addEventListener("load", () => {
                acoeoFileName.binary = uploadReader.result;
            });
            document.querySelector("#acoeoAddParthner").addEventListener("click", function(){acoeoPopup(true)}, false);
            document.querySelector("#acoeoCloseDialog").addEventListener("click", closePopUp, false);
            document.querySelector("#acoeoTableParthner").addEventListener("click", acoeoEditBtn, false);
            document.querySelector("#acoeoFormSave").addEventListener("submit", sendData, false);
            if(acoeoFileName.dom.files[0]) {
                uploadReader.readAsBinaryString(acoeoFileName.dom.files[0]);
            }
            acoeoFileName.dom.addEventListener( "change", () => {
                if( uploadReader.readyState === FileReader.LOADING ) {
                    uploadReader.abort();
                }

                uploadReader.readAsBinaryString( acoeoFileName.dom.files[0] );
            } );
            acoeoRenderParthners();
        });
    </script>
</body>
</html>
