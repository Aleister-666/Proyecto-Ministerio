<div class="modal fade" id="{{$modal_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$modal_id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Archivos cliente X</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <nav>
          <div class="nav nav-tabs flex-nowrap overflow-auto" id="nav-tab" role="tablist">
            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="true" title="Copias de la cedula de Identidad" data-file-path="">Cedulas</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Constancia de trabajo" data-file-path="">C.Trabajo</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Constancia de residencia" data-file-path="">C.Residencia</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Constancia de matrimonio, solteria, union...." data-file-path="">C.Matrimonio</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Partidas de nacimiento de hijos menores" data-file-path="">P.Nacimientos</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Declaracion jurada de no poseer vivienda" data-file-path="">D.Jurada</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Plantilla de inscripcion Gran Mision Vivienda Venezuela" data-file-path="">Pl.GMVV</button>

            <button class="nav-link disabled" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" title="Exposicion de motivos" data-file-path="">E.Motivos</button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-home-tab">
            <iframe id="frame-document" class="d-none" src="" frameborder="0" width="100%" height="100%"></iframe>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary flex-grow-1" data-bs-dismiss="modal">Cancelar</button>

        <a href="#" id="download-all-btn" type="button" class="btn btn-primary flex-grow-1" title="Descargar todos los documentos" download>Descargar</a>
      </div>
    </div>
  </div>
</div>
