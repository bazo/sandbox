requirejs.config({
	//By default load any module IDs from js/lib
	baseUrl: '/vendor/',
	paths: {
		jquery: 'jquery/jquery',
		bootstrap: "bootstrap/dist/js/bootstrap.min",
		ajaxForm: '/js/jquery.ajaxform',
		netteForms: "/js/netteForms",
		netteAjax: '/js/nette.ajax.js-master/nette.ajax'
	},
	shim: {
		bootstrap: {
			deps: ["jquery"]
		},
		ajaxForm: {
			deps: ["jquery"]
		},
		netteAjax: {
			deps: ["jquery"]
		}
	}
});

var dependencies = [
	"jquery",
	"bootstrap",
	"netteForms",
	"ajaxForm",
	"netteAjax"
];

require(dependencies, function(jquery, bootstrap, netteForms, ajaxForm) {
	main();
}
);

function main() {

	$.each(q, function(index, f) {
		$(f);
	});

}
;
