
¿Como se guardan los datos de la ficha?
[TABLA: RE_Habilidades (Listado de habilidades normalizadas)]
							|
							|
							V
[TABLA: RE_Habilidades_pj (Asignacion de habilidades a pj)]
							|
							|
							V
[TABLA: RE_Atributos (Repositorio principal de fichas de pj)]


¿Como se pide una ficha?
El circuito es el siguiente:
RE_Solicitud.php --> RE_SolCommit.php --> RE_SolSave.php
Se almacenan los datos en tablas temporales que son copiados a las tablas de trabajo una vez aprobada la ficha.
