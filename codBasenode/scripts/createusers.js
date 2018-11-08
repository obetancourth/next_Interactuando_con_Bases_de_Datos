const mongoose = require('mongoose'),
      Usuario = require('../src/models/usuarios');

let userTemplate = {
  useremail : 'someemail@email.com',
  username  : 'NextUser1',
  userpswd  : 'Ne%tUs3r1',
  userfchnac: new Date(1984,5,23)
};

mongoose.connection.on('error', console.error.bind(console, 'connection error:'));
mongoose.connection.once('open', function() {
  let user = new Usuario(userTemplate);
  user.save((err)=>{
    if(err) return console.log(err);
    return console.log("Usuario Guardado");
  })
});;
mongoose.connect('mongodb://localhost/next');
