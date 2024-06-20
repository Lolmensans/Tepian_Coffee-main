var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.get('/about', function(req, res, next) {
  res.render('about', { title: 'Express' });
});

router.get('/news', function(req, res, next) {
  res.render('news', { title: 'Express' });
});

router.get('/drinks', function(req, res, next) {
  res.render('drinks', { title: 'Express' });
});

module.exports = router;
