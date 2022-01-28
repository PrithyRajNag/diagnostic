
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

requirejs(["lodash"], function (lodash) {
    const headerEl = document.getElementById("downloadBtn");
    headerEl.textContent = lodash.upperCase("hello world");
});
