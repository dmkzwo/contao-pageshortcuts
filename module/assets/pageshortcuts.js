var $j = jQuery.noConflict();
var ajCon = 'system/modules/pageshortcuts/tools/ajax.php';

$j(document).ready(function(){
});



function dzToggleIndex(id) {
  $j.get(ajCon+'?mode=toggleindex&id='+id);
}


function dzToggleFollow(id) {
  $j.get(ajCon+'?mode=togglefollow&id='+id);
}

function dzToggleCache(id, self) {
  $j.getJSON(ajCon+'?mode=togglecache&id='+id,
    function(data){
      var includeCache = data.includeCache;
      var cache = data.cache;
      if (includeCache == '') {
        self.attr('class', 'parentcache');
        self.html('--');
      } else {
        if (cache == '0') {
          self.attr('class', 'nocache');
          self.html('nc');
        } else {
          self.attr('class', 'cache');
          self.html('60');
        }
      }
    }
  );
}

function dzToggleSearch(id) {
  console.log('search');
  $j.get(ajCon+'?mode=togglesearch&id='+id);
}

function dzToggleSitemap(id) {
  $j.get(ajCon+'?mode=togglesitemap&id='+id);
}

