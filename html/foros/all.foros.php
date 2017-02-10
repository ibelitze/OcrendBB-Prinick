<?php include(HTML_DIR . 'overall/header.php'); ?>

 <body>
 <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

 <?php include(HTML_DIR . '/overall/topnav.php'); ?>

 <section class="mbr-section mbr-after-navbar">
 <div class="mbr-section__container container mbr-section__container--isolated">

   <?php
   if(isset($_GET['success'])) {
     echo '<div class="alert alert-dismissible alert-success">
       <strong>Completado!</strong> el foro ha sido borrado correctamente.
     </div>';
   }
   if(isset($_GET['error'])) {
     echo '<div class="alert alert-dismissible alert-danger">
       <strong>Error!</strong></strong> el nombre del foro no puede quedar vacío.
     </div>';
   }
   ?>

 <div class="row container">
    <div class="pull-right">
      <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
           <a class="mbr-buttons__btn btn btn-danger active" href="?view=configforos">GESTIONAR FOROS</a>
       </li></ul></div>
        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORIAS</a>
        </li></ul></div>
        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos&mode=agregar">CREAR FOROS</a>
        </li></ul></div>
      </div>

     <ol class="breadcrumb">
       <li><a href="?view=index"><i class="fa fa-comments"></i> Foros</a></li>
     </ol>
 </div>

 <div class="row categorias_con_foros">
   <div class="col-sm-12">
       <div class="row titulo_categoria">Gestión de foros</div>

       <div class="row cajas">
         <div class="col-md-12">


           <?php
           if($foros != null) {
            $HTML = '<table class="table"><thead><tr>
            <th style="width: 10%">Id</th>
            <th style="width: 25%">Nombre del foro</th>
            <th style="width: 15%">Descripción</th>
            <th style="width: 15%">Cantidad de mensajes</th>
            <th style="width: 10%">Estado</th>
            </tr></thead>
            <tbody>';


             foreach($foros as $id_categoria => $link) {

               $estado = $link['estado'] == 1 ? 'Abierto' : 'Cerrado';

                 $HTML .= '<tr>
                   <td>'.$link['id'].'</td>
                   <td>'.$link['nombre'].'</td>
                   <td>'.$link['descripcion'].'</td>
                   <td>'.$link['cantidad_mensajes'].'</td>
                   <td>'. $estado .'</td>
                   <td>
                     <div class="btn-group">
                      <a href="#" class="btn btn-primary">Acciones</a>
                      <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="?view=configforos&mode=editar&id='.$link['id'].'">Editar</a></li>
                        <li><a onclick="DeleteItem(\'¿Está seguro de eliminar este foro?\',\'?view=configforos&mode=borrar&id='.$link['id'].'\')">Eliminar</a></li>
                      </ul>
                    </div>
                   </td>
                 </tr>';
             }
             $HTML .= '</tbody></table>';
           } else {
             $HTML = '<div class="alert alert-dismissible alert-info"><strong>INFORMACIÓN: </strong> Todavía no existe ningún foro.</div>';
           }
           echo $HTML;
           ?>


       </div>
   </div>
 </div>

 </div>
 </section>

 <?php include(HTML_DIR . 'overall/footer.php'); ?>

 </body>
 </html>
