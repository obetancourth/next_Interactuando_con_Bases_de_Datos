const express = require('express');
let router = express.Router(),
    userrouter = require('./usuarios'),
    eventrouter = require('./eventos');


const verifySignin = (req, res, next)=>{
  if(!req.session.user){
    return res.send('Not Allowed');
  }
  return next();
}
router.use('/', userrouter);
router.use('/events', verifySignin ,eventrouter);

module.exports = router;
