var MongoClient = require('mongodb').MongoClient


// Config Options
var url = "mongodb://localhost:27017";
var database_name = 'assignment';


// Pagination number to show at time
var total=8;
// Assign the value for reference use

var DB;

MongoClient.connect(url, function(err, db) {
    if (err)
      return err;
    DB = db.db(database_name);
});



exports.loginCheck= function(data,done){
  
   DB.collection('login').findOne(data,function(err,result){
      if(err)
        done(err,null);
      done(null,result);
   });
   
};

exports.loginInsert= function(data,done){
  
   DB.collection('login').insert(data,function(err,result){
      if(err)
        done(err,null);
      done(null,result);
   });
   
};

exports.articles = function(done){
 
   DB.collection('articles').find({}).toArray(function(err,result){
       if(err)
        done(err,null);
      var col_res = [];
      // console.log(result);
      DB.collection('login').find({}).toArray(function(e,r){
           // console.log(r);
           result.forEach(function(data){
                r.forEach(function(d){
                    // console.log(d);
                   if(d.email_id==data.email_id){
                      var ll=data;
                      ll.pic_name = d.pic_name;
                      ll.name     = d.name;
                      col_res.push(ll);
                   }
                });
           });
           // console.log(col_res);
           done(null,col_res);

      });
     
   });
}

exports.articleInsert= function(data,done){

   DB.collection('articles').find({}).count(function(e,count){
      data.article_id=count+1;
      DB.collection('articles').insert(data,function(err,result){
        if(err)
          done(err,null);
        done(null,result);
       });   
   });
}


exports.articlesOwn = function(cond,done){ 
   DB.collection('articles').find(cond).toArray(function(err,result){
       if(err)
        done(err,null);
           done(null,result);     
   });
}


exports.articlesPagination = function(cond,val,done){
   val = (val-1)*total;
   var col_res = [];
   DB.collection('articles').find(cond).toArray(function(err,result){
       if(err)
        done(err,null);
     
      console.log(result);
      DB.collection('login').find({}).toArray(function(e,r){
           // console.log(r);
           result.forEach(function(data){
                r.forEach(function(d){
                    // console.log(d);
                   if(d.email_id==data.email_id){
                      var ll=data;
                      ll.pic_name = d.pic_name;
                      ll.name     = d.name;
                      col_res.push(ll);
                   }
                });
           });
           // console.log(col_res);
           done(null,col_res.splice(val,total));

      });
     
   });
}


exports.readArticle = function(email_id,cond,done){


   DB.collection('articles').find(cond).toArray(function(err,result){
       var cond1 = {};
       cond1.email_id = result[0]['email_id'];
      DB.collection('login').find(cond1).toArray(function(e,r){
           result[0].pic_name=r[0].pic_name;
           result[0].name    =r[0].name;
           DB.collection('likes').aggregate([
            {
                $group : {
                    _id : null,
                    totalPrice: { $sum: 'type' }
                }
            }
        ]).toArray(function(error, resul) {
            if (err) return err;
              console.log('I think it"s right ');
              console.log(resul);
              result[0].totalPrice = resul[0].totalPrice;
              cond.email_id = email_id;
              console.log(cond);
              DB.collection('likes').find(cond).count(function(e,count){
                if(count){
                  result[0].fortype = 'upd';
                }
                else{
                  result[0].fortype = 'ins';
                }
                DB.collection('likes').find(cond).toArray(function(err,res){
                  console.log("hello Bosss");
                  console.log(res);
                  if(res.length)
                    result[0].color='blue';
                  else
                    result[0].color='lightgray';
                  done(e,result);
                });
              });
              
         });
          
      });
     
   });

}

exports.like_update = function(cond,newV,cmd,done){
      if(cmd=='ins'){
           cond.type = newV.type;
           DB.collection('likes').insert(cond,function(err,res){
                done(err,res);
           });
      }else{

           DB.collection('likes').updateOne(cond, {set: newV },function(err,res){
              done(err,res);
           });
      }

}





exports.total = total;




