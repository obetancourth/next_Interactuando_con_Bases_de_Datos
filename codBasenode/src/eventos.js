const express = require('express');
let router = express.Router(),
    Evento = require('./models/eventos');

router.get('/all', (req, res)=>{
  if(!(req.session.user && true)) {
    return res.json([]);
  }
  Evento.find({usuario: req.session.user._id}, (err, events)=>{
      if(err) {return res.json([])}
      let _events = events.map((e,i)=>{
        return {
          "id" : e._id,
          "title" : e.title,
          "start" : e.start,
          "end" : e.end,
          "allDay": e.allDay
        }
      });
      return res.json(_events);
  });
});// all

router.post('/new', (req, res)=>{
    let _event = {... req.body};
    _event.allDay = _event.end === "";
    _event.usuario = req.session.user._id;
    let _eventIns = new Evento(_event);
    _eventIns.save(function(err, _sevent){
      if(err) return res.send("Error al guardar evento");
      return res.json({"id": _sevent._id});
    });
});

router.post('/delete/:id', (req, res)=>{
  let _id = req.body.id;
  let _cid = req.params.id;
  if(_id === _cid){
    Evento.findByIdAndDelete(_id, function(err, rslt){
      if(err){
        return res.send("Error al eliminar evento");
      }
      return res.send("Evento Eliminado");
    });
  }else{
    return res.send("Error al eliminar evento, parametros comprometidos");
  }
}); //


router.post('/update/:id', (req, res) => {
  let _id = req.body.id;
  let _cid = req.params.id;
  if (_id === _cid) {
    Evento.findByIdAndUpdate( _id,
      {
        "$set":{
          "start":req.body.start,
          "end":req.body.end
        }
      },
      function (err, rslt) {
        if (err) {
          return res.json({"msg":"Error al Actualizar evento"});
        }
        return res.json({"msg":"OK"});
      }
    );
  } else {
    return res.send("Error al actualizar evento, parametros comprometidos");
  }
}); // delete

module.exports = router;
