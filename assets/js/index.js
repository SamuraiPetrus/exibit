import ExibitPreview from './exibit-preview.js';
import ExibitVetor from './vetor/exibit-vetor.js';
import ExibitDisplay from './exibit-display.js';
import ExibitReset from './exibit-reset.js';
import ExibitDragDrop from './exibit-drag-drop.js';

//Ações do usuário
$('#exibit_preview').change(ExibitPreview);
$("#exibit-vetor").click(ExibitVetor);
$("#exibit-display").change(ExibitDisplay);
$('#exibit-reset').click(ExibitReset);

ExibitDragDrop();
