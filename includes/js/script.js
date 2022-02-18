(function( $ ) {
	function processHttpRequest(url, data, re){
        if(url && data){
            return $.ajax({
               	url: url,
               	data: data,
               	cache: false,
               	type: 'post',
               	datatype: re
            }).promise();
        }
    }
    function convertDate(date){
    	var t = date.split(/[- :]/);
    	var newDate = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
    	return newDate;
    }

	$('#regform').on('submit', function(e){
		e.preventDefault();
		var reg = new FormData($(this)[0]);
		console.log(reg);
		$.ajax({
            type: "POST",
            url: "controller/register.php",
            data: reg,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $('#regactioncomment').html(data);
            }
        });
	});

	//  $('div.chat_list').on('click', function(e){
	// 	//var udata = $('div.uname').text();
	// 	var udata = $(this).data('udata');
	// 	var dataobj = ((typeof udata !== 'object') ? JSON.parse(udata) : udata);
	// 	console.log(dataobj);
	// 	var processdata = "id="+dataobj.r_id+"&r_uname="+dataobj.r_uname+"&r_name="+dataobj.r_name+"&email="+dataobj.email+"&r_type=get_chat";
	// 	processHttpRequest('controller/process.php', processdata, 'json').then(function(rs){

	// 	});
	// });


	//Chat
	var Chat = {
		init: function ( config ){
			this.config = config;
			this.bindEvents();			
			// this.initChatVars();
		},
		bindEvents: function(){			 
			this.config.chat_list.on('click', function(){
				var $self  = Chat, $this = $(this);
				//initialize pagination variables
				$self.initChatVars();
				//fetch messages
				$self.config.activeUser = $this.data('udata').r_id;
				$self.config.user = $this.data('udata');
				//console.log($this.data('udata'));
				$self.fetchChat($self.config.user);
				//console.log($this);
				//console.log($self.config.lastMsgId);
			});
			this.config.sendbtn.on('click', function(e){
				var $self  = Chat, $this = $(this);
				e.preventDefault();
				$self.sendMsg($self.config.user);
			});
			this.config.msg_body.on('scroll', function(e){
				var $self  = Chat, $this = $(this);
				//console.log();
				if(e.target.scrollTop === 0){
					$self.currentpage++;
					$self.offset = ($self.currentpage - 1) * $self.perpage;
					//$self.perpage = $self.perpage * $self.currentpage;					
					//fetch Messaes with new parameters
					//after fetching, prepend to the result
					//console.log($self.currentpage +" "+ $self.offset);
					$self.scrollMsg($self.config.user);
				}				
			});
		},
		sendMsg: function( user ){
			var self = Chat;
			var dataobj =  user;
			//console.log(dataobj);

			self.config.activeUser = dataobj.r_id;
			//console.log(self.config.activeUser);

			var chatData = "msg="+self.config.chat_msg.val()+"&sender="+self.config.loggedUser+"&r_id="+self.config.activeUser+"&r_type=sendmsg";
			console.log(chatData);
			processHttpRequest('controller/process.php', chatData, 'json').then(function(result){
				console.log(result);
				if(typeof result == 'object' && result.success){
					console.log('sent');
				}
			});
		},
		fetchChat: function(user){
			var self = Chat;			
			var $udata = user;
			//console.log($udata);
			var dataobj =  $udata;
			//console.log(dataobj);

			var processdata = "r_id="+dataobj.r_id+"&r_uname="+dataobj.r_uname+"&r_name="+dataobj.r_name+"&email="+dataobj.email+"&perpage="+ self.perpage +"&cupage="+ self.currentpage +"&offset="+ self.offset +"&r_type=get_chat";
			//console.log(processdata);
			processHttpRequest('controller/process.php', processdata, 'json').then(function(rs){
				var rs_obj = JSON.parse(rs);
				//console.log(rs);
				if(typeof rs_obj == 'object'){
					//console.log(JSON.parse(rs_obj));
					var chatSets = '';
					//console.log(rs_obj.length);
					for(var i in rs_obj){
						//console.log(rs_obj[i]);
						if(rs_obj[i].sender != self.config.loggedUser ){
							chatSets += '<div class="incoming_msg fetched" data-idata="'+ rs_obj[i].id +'"><div class="incoming_msg_img"> <img src="media/img/chat_user.png" alt="chat"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+ rs_obj[i].message +'</p><span class="time_date"> '+ convertDate(rs_obj[i].c_date) +'</span></div></div></div>';
						}else{
							chatSets += '<div class="outgoing_msg fetched" data-idata="'+ rs_obj[i].id +'" ><div class="sent_msg"><p>'+ rs_obj[i].message +'</p><span class="time_date"> '+ convertDate(rs_obj[i].c_date) +'</span> </div></div>';
						}				
					}
					self.config.msg_body.empty();
					$(chatSets).appendTo(self.config.msg_body);
					self.config.lastMsgId = $('.msg_history').first().find('.fetched').last().data('idata');
					//get New Messages
					clearInterval(self.config.setIntervals);
					self.getNewMsg(self.config.lastMsgId);					
					//console.log(rs_obj[i].id);	
					self.config.msg_body.scrollTop(self.config.msg_body[0].scrollHeight);		
				}
			});
		},
		getNewMsg: function( id ){
			var self = Chat;
			lastMsgId = id;
			$user_data = self.config.user;
			
			self.config.setIntervals = setInterval(function(){
				var lastMsgdata = "r_id="+$user_data.r_id+"&r_uname="+$user_data.r_uname+"&r_name="+$user_data.r_name+"&email="+$user_data.email+"&sender_id="+self.config.loggedUser+"&perpage="+ self.perpage +"&cupage="+ self.currentpage +"&offset="+ self.offset +"&lastMsgId="+ lastMsgId +"&r_type=get_last_chat";
				processHttpRequest('controller/process.php', lastMsgdata, 'json').then(function(lstMsgRes){
					var newMsg_obj = JSON.parse(lstMsgRes);
					//console.log(newMsg_obj);
					if(typeof newMsg_obj == 'object'){
						var lstChatSets = '';
						//console.log(newMsg_obj.length);
						for(var i in newMsg_obj){
							//console.log(rs_obj[i]);
							if(newMsg_obj[i].sender != self.config.loggedUser ){
								lstChatSets += '<div class="incoming_msg fetched" data-idata="'+ newMsg_obj[i].id +'"><div class="incoming_msg_img"> <img src="media/img/chat_user.png" alt="chat"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+ newMsg_obj[i].message +'</p><span class="time_date"> '+ convertDate(newMsg_obj[i].c_date) +'</span></div></div></div>';
							}else{
								lstChatSets += '<div id="" class="outgoing_msg fetched" data-idata="'+ newMsg_obj[i].id +'"><div class="sent_msg"><p>'+ newMsg_obj[i].message +'</p><span class="time_date"> '+ convertDate(newMsg_obj[i].c_date) +'</span> </div></div>';
							}				
						}
						$(lstChatSets).appendTo(self.config.msg_body);
						self.config.lastMsgId = $('.msg_history').first().find('.fetched').last().data('idata');

						clearInterval(self.config.setIntervals);
						self.getNewMsg(self.config.lastMsgId);
						//self.config.msg_body.scrollTop(self.config.msg_body[0].scrollHeight);
					}				
				});

			}, 1000)
		},
		scrollMsg: function(user){
			var self = Chat;
			var dataobj =  user;
			//console.log(dataobj);

			self.config.activeUser = dataobj.r_id;
			//console.log(self.config.activeUser);


			var scrolldata = "r_id="+dataobj.r_id+"&r_uname="+dataobj.r_uname+"&r_name="+dataobj.r_name+"&email="+dataobj.email+"&perpage="+ self.perpage +"&cupage="+ self.currentpage +"&offset="+ self.offset +"&r_type=scroll_chat";
			//console.log(scrolldata);
			processHttpRequest('controller/process.php', scrolldata, 'json').then(function(sresult){
				var scroll_obj = JSON.parse(sresult);
				//console.log(sresult);
				if(typeof scroll_obj == 'object'){
					//console.log(JSON.parse(rs_obj));
					var scrollChatSets = '';
					//console.log(rs_obj);
					for(var i in scroll_obj){
						//console.log(rs_obj[i].c_date);
						if(scroll_obj[i].sender != self.config.loggedUser ){
							scrollChatSets += '<div class="incoming_msg"><div class="incoming_msg_img"> <img src="media/img/chat_user.png" alt="chat"> </div><div class="received_msg"><div class="received_withd_msg"><p>'+ scroll_obj[i].message +'</p><span class="time_date"> '+ convertDate(scroll_obj[i].c_date) +'</span></div></div></div>';
						}else{
							scrollChatSets += '<div id="" class="outgoing_msg"><div class="sent_msg"><p>'+ scroll_obj[i].message +'</p><span class="time_date"> '+ convertDate(scroll_obj[i].c_date) +'</span> </div></div>';
						}				
					}
					//console.log(scrollChatSets);
					$(scrollChatSets).prependTo(self.config.msg_body);
				}
			});
		},
		initChatVars: function(){
			this.config.msg_body.empty();
			this.perpage 		= 8;
			this.currentpage 	= 1;
			this.offset 		= (this.currentpage - 1) * this.perpage;
		}
	}
	Chat.init({
		user: undefined,
		lastMsgId: undefined,//$('div.chat_list  div.incoming_msg:last-child').data('idata'),
		chat_list: $('div.chat_list'),
       	i_msg: $('#incoming_msg'),
       	o_msg: $('#outgoing_msg'),
       	msg_body: $('.msg_history').first(),
       	activeUser: undefined,
       	loggedUser: $('#loggeduser').text(),
       	chat_msg: $('#chat_msg'),
       	sendbtn: $('#sendbtn'),
       	setIntervals: undefined
    });
    $('.chat_list').each(function(){
    	$(this).click(function(){
    		$(this).addClass('active').siblings('.chat_list').removeClass('active');
    	});
    });
})( jQuery );