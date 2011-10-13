  /**
   * @fn
   *
   *	$f.addmodule({
   *		_name_: $nomModule,
   *		$maVariable: $value,
   *		$maFonction: function($args){}   			
   *	});
   *
   * @brief 
   * @file module.js
   * 
   */

$f.addmodule({
	
	_name_:"module",
	
	user: new Object({
		test:"toto"
	}),

	action:function(e){
		console.log("start action")
		console.log(this.user.test);
		console.log("end action");
		// definition de ma fonction
	}

});

$f.addmodule({
	
	_name_:"module",

	action2:function(e){
		console.log("start action2")
		console.log(this.user.test);
		console.log("end action2");
		// definition de ma fonction
	}

});