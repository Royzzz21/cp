// DB Data
module.exports = {
    db_config: {
        host : '127.0.0.1',
        port : 3306,
        user : 'root',
        password: 'aktlakfh',
        database : 'monix'
    },

    safe_str: function (str) {
        if(typeof str=='undefined'){
            return '';
        }
        var blank_pattern = /^\s+|\s+$/g;
        return str.replace( blank_pattern, '' );

    },

    safe_int: function (num) {
        if(typeof num=='undefined'){
            return 0;
        }
        // var blank_pattern = /^\s+|\s+$/g;
        // return str.replace( blank_pattern, '' );

        console.log('safe_int: typeof='+typeof num);

        if(typeof num=='number'){
            return num;
        }

        // convert to number
        num=num*1;

        //if()
        return num;
    },


    get_pairs: function() {
        // 차트데이타 select
        var q = "select pair_id as pair_id from pairs";

        global.client.query(q, [], function (error, result, fields) {
            if (error) {

                // var rtn_obj = {
                //     "s": "no_data"
                // };
                // var rtn = JSON.stringify(rtn_obj);
            }
            else {
                // var rtn_obj = {};

                if(result.length>0){
                    for (var k in result) {
                        var pair_id=(result[k].pair_id).replace('/', '').toLowerCase();
                        console.log('get_pairs: '+pair_id);
                        global.pairs_list.push(pair_id);
                    }
                }

            }
        });
    }

};

