const mongoose = require('mongoose'),
      Schema = mongoose.Schema,
      bcrypt = require('bcrypt');

let UsuariosSchema = Schema({
  useremail : {
                  type:String,
                  required:true,
                  validator: function(v) {
                    return /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/.test(v);
                  },
                  unique: true
              },
  username  : {type:String, required:true},
  userpswd  : {type:String, required:true},
  userfchnac: {type:Date},
});

UsuariosSchema.pre('save', function(next){
  let usuario = this;
  if (!usuario.isModified("userpswd")) return next();

  bcrypt.genSalt(10, (err, salt) => {
    if (err) return next(err);
    bcrypt.hash(usuario.userpswd, salt, function(err, hash) {
        if (err) return next(err);
        usuario.userpswd = hash;
        next();
    });// hash
  }); //genSalt
});//pre

UsuariosSchema.methods.validarPassword = function(pswd, callback){
  bcrypt.compare(pswd, this.userpswd, (err, isMatch) => {
        if (err) return callback(err);
        callback(null, isMatch);
    });
};

module.exports = mongoose.model("Usuarios", UsuariosSchema, "usuarios");
