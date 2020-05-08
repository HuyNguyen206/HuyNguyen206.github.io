var express = require('express');
var router = express.Router();
const { Pool, Client } = require('pg')
const pool = new Pool({
  user: 'postgres',
  host: 'localhost',
  database: 'SampleDB',
  password: '123456',
  port: 5432,
})


/* GET home page. */
router.get('/', function (req, res, next) {
});

/* GET data from Postgresql. */
router.get('/get-data', function (req, res, next) {
  pool.query('SELECT * FROM product', (err, respond) => {
    if (err) {
      console.log(err)
    }
    else {
      // console.log(respond)
      res.send(respond.rows)
    }

    // console.log('huy dep trai')
    // pool.end()
  })
});
router.get('/add', function (req, res, next) {
  res.render('form_product', {})
});

router.post('/add', function (req, res, next) {
  var product_name = req.body.product_name,
    product_price = req.body.product_price,
    image = req.body.image;
  pool.query('insert into product (product_name, product_price, image) values ($1, $2, $3)',
    [product_name, product_price, image], (err, respond) => {
      if (err) {
        console.log(err)
      }
      else {
        res.send('<h1>Insert dữ liệu thành công:</h1><div>' + product_name + '</div>' + '<div>' + product_price + '</div><div>' + image + '</div>');
      }
    })

});



module.exports = router;
