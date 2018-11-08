const express = require('express');
let router = express.Router(),
    Usuario = require('./models/usuarios');


router.post('/login', (req, res)=>{
  let {user, pass} = req.body;
  Usuario.findOne({ useremail: user }, function(err, _usuario) {
    if (err) throw err;
    if (!_usuario) return res.send("invalido");
    _usuario.validarPassword( pass, (err, isMatch) => {
        if (err) throw err;
        console.log(isMatch);
        if ( isMatch ) {
          req.session.user = _usuario.toJSON();
          //eliminamos el atributo password ya que no es necesario
          delete req.session.user.userpswd;
          return res.send("Validado");
        }
        return res.send("invalido");
    });
});
});//login

router.get('/logout', (req, res) => {
  delete req.session.user;
  res.send("OK");
});

module.exports = router;
