const http        = require('http'),
      express     = require('express'),
      bodyParser  = require('body-parser'),
      path        = require('path'),
      mongoose    = require('mongoose'),
      session     = require('express-session');

let   app         = express(),
      Server      = http.Server(app),
      port        = process.env.port || 3000,
      router      = require('../src/index.js');

app.use(session({
  secret: '0f63d0a9d52db8c4c056413c867e32263d27fc0998c99ac82eeb7865e416a619',
  resave: false,
  saveUninitialized: true,
  cookie: { secure: false }
}));

app.use(bodyParser.urlencoded({extended: false}))
app.use(bodyParser.json())

app.use(express.static('client'));

app.use('/', router);

app.all('*', (req, res) => {
  res
    .status(404)
    .json({"message": "Recurso No encontrado"});
});

//Iniciando Conección a Mongoose
mongoose.connection.on('error', console.error.bind(console, 'connection error:'));
mongoose.connection.once('open', function() {
  Server.listen(port, () => {
    console.log(`Server Started on port ${port}`);
  });
});;
mongoose.connect('mongodb://localhost/next');
