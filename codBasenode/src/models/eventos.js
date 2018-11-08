const mongoose = require('mongoose'),
      Schema = mongoose.Schema;

let Eventos = new Schema({
  "title": {type: String, required:true},
  "start": {type: String, required:true},
  "end": {type: String},
  "usuario": {type: String},
  "allDay": {type:Boolean}
});

module.exports = mongoose.model("Eventos", Eventos, "eventos");
