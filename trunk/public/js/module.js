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
		$f.alert("load");
		// definition de ma fonction
	}

});