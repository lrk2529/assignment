

const models = require('./models')
const express = require('express');
const bodyParser = require('body-parser');

const sessions = require('express-session');


var multer = require('multer');

const app = express();


app.use(express.static('uploads'))



app.use(bodyParser.urlencoded());
app.use(bodyParser.json());



app.set('view engine', 'ejs');

app.use(sessions({
  secret: 'just do when r u free? ',
  resave: false,
  saveUninitialized: false
}));



app.get("/",function(req,res){
	 res.render(__dirname+'/views/login');
});

app.post("/",function(req,res){
	
	 models.loginCheck(req.body,function(err,result){
	 	if(err)
	 		return err;
	 	console.log(result);
	 	if(result){
	 	  req.session.validation = result;
	 	  res.redirect("/home");
	 	}
	 	else
	 	   res.redirect("/");
	 });
});


app.get('/home',function(req,res){
	if(req.session.validation){
		models.articles(function(error,result){
			if(error)
				return error;
			console.log(result);
			var totalLength = Math.ceil(result.length / models.total)
			
			res.render(__dirname+'/views/home',{results: result.splice(0,models.total),total: totalLength,maxVisble:models.total});
		});
	}else{
		res.redirect('/');
	}
});



app.post('/signup',function(req,res){

	   var Storage = multer.diskStorage({
     				destination: function(req, file, callback) {
         				callback(null, './uploads/profile');
				     },
				     filename: function(req, file, callback) {
				         callback(null, file.fieldname + "_" + Date.now() + "_" + file.originalname);
				     }
				 });

		var upload=multer({storage:Storage}).single("pic");

		upload(req, res, function(err) {

			var data= req.body;
			data.pic_name =  req.file.filename;
			req.session.validation = data;
			models.loginInsert(data,function(error,ressult){
				if(error)
					return error;
				console.log('Signup is successfully');
			});
			//console.log(data);
	         if (err) {
	          	return res.redirect('/');
	         }
	         return res.redirect('/home');
	     });

});


app.get('/logout',function(req,res){

	if(req.session.validation){
		req.session.destroy();
	}
	res.redirect('/');

});


app.get('/write',function(req,res){
	if(req.session.validation){
		res.render(__dirname+'/views/write');
	}else{
		res.redirect('/');
	}
});



app.post('/writeInsert',function(req,res){

	   var Storage = multer.diskStorage({
     				destination: function(req, file, callback) {
         				callback(null, './uploads/article');
				     },
				     filename: function(req, file, callback) {
				         callback(null, file.fieldname + "_" + Date.now() + "_" + file.originalname);
				     }
				 });

		var upload=multer({storage:Storage}).single("pic");

		upload(req, res, function(err) {
			
			var data= {};
			data.image_link =  req.file.filename;
			data.email_id  = req.session.validation.email_id;
			data.article_id = 2;
			data.headling 	= req.body.headline;
			models.articleInsert(data,function(error,ressult){
				if(error)
					return error;
				console.log('Article insert successfully');
			});
	        return res.redirect('/write');
	     });

});


app.get('/own',function(req,res){
	if(req.session.validation){
		var cond={};
		cond.email_id = req.session.validation.email_id;
		models.articlesOwn(cond,function(error,result){
			if(error)
				return error;
			var col_res = []; 
			 result.forEach(function(data){
                 
                      var ll=data;
                      ll.pic_name = req.session.validation.pic_name;
                      ll.name     = req.session.validation.name;
                      col_res.push(ll);
              
           });

			var totalLength = Math.ceil(col_res.length / models.total);

			res.render(__dirname+'/views/own',{results: col_res.splice(0,models.total),total: totalLength,maxVisble:models.total});
		});
	}else{
		res.redirect('/');
	}
});

 app.get('/ajaxCall/:val',function(req,res){
 	 models.articlesPagination({},req.params.val,function(err,result){
	 	 res.write(JSON.stringify(result));
	 	 res.end();
 	 });
 	 
 });

 app.post('/ajaxCall/:val',function(req,res){
 	var cond={};
	cond.email_id = req.session.validation.email_id;
 	 models.articlesPagination(cond,req.params.val,function(err,result){
	 	 res.write(JSON.stringify(result));
	 	 res.end();
 	 });
 	 
 });


 
app.get("/read/:val",function(req,res){
 	var cond={};
	cond.article_id = parseInt(req.params.val);
	console.log(cond);
	var email_id = req.session.validation.email_id;
 	 models.readArticle(email_id,cond,function(err,result){
 	 	 console.log(result);
	 	 res.render(__dirname+"/views/read",{value: result[0]});
 	 });
 	 
});


app.get('/like_update/:val/:article_id/:cmd',function(req,res){
	 if(req.session.validation.email_id){
	 	var cond={};
		cond.email_id = req.session.validation.email_id;
		cond.article_id = req.params.article_id ;
		var newV = {};
		newV.type = req.params.val;
		models.like_update(cond,newV,req.params.cmd,function(err,rss){
				res.write(JSON.stringify(req.params));
	 			res.end();
		});
	 }

	  
});













app.listen(9001,function(err){
	console.log('Some body ping the server');
});







