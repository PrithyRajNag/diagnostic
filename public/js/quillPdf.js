/******/
/*!**********************************!*\
  !*** ./resources/js/quillPdf.js ***!
  \**********************************/
// require('file-saver');
// require('quill-to-pdf');
// // const {Quill} = require("../../public/assets/js/quill");
// // const Quill = require('quilljs');
// //
// // const quillInstance = new Quill();
//
// // Here is your export function
// // Typically this would be triggered by a click on an export button
//

// requirejs(["lodash"], function (lodash) {
//   var headerEl = document.getElementById("downloadBtn");
//   headerEl.textContent = lodash.upperCase("hello world");
// });
// /******/ })()
// ;

// const {pdfExporter} = require("quill-to-pdf");
// let quill = new Quill('#editor', {
//     modules: {
//         syntax: false,
//     },
//     placeholder: 'Enter Your Text Here...',
//     theme: 'bubble',
//     disabled: true,
// });
//
// $(document).ready(function () {
//     let value = $('#data').val()
//     let da = JSON.parse(value)
//     quill.setContents(da)
//     quill.disable()
// })
//
// async function pdfExport() {
//     const delta = quill.getContents(); // gets the Quill delta
//     const pdfAsBlob = await pdfExporter.generatePdf(delta); // converts to PDF
//     saveAs(pdfAsBlob, 'pdf-export.pdf'); // downloads from the browser
// }
requirejs(["lodash"], function (lodash) {
  var headerEl = document.getElementById("downloadBtn");
  headerEl.textContent = lodash.upperCase("hello world");
});
