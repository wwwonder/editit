/**
 *
 * Add Button for TinyMCE
 *
 * @file           tinymce.js
 * @package        editit
 * @author         Masato Takahashi
 * @copyright      2014 wwwonder
 * @version        Release: 1.0.0
 * @filesource     wp-content/themes/editit/framework/inc/tinymce/tinymce.js
 */



/*-----------------------------------------------------------------------------------*/
/* 01. Add TinyMCE Columns Button
/*-----------------------------------------------------------------------------------*/
(function() {
  tinymce.create('tinymce.plugins.columns', {
    init : function(ed, url) {
      ed.addCommand('mceColumns', function() {
        ed.windowManager.open({
          file : url + '/window.php?',
          width : 800 + ed.getLang('columns.delta_width', 0),
          height : 400 + ed.getLang('columns.delta_height', 0),
          inline : 1
        }, {
          plugin_url : url
        });
      });
      ed.addButton('columns', {
        title : 'Columns',
        icon  : 'columns',
        cmd   : 'mceColumns'
      });
    },
    createControl : function(n, cm) {
      return null;
    },
  });
  tinymce.PluginManager.add('columns', tinymce.plugins.columns);
})();



/*-----------------------------------------------------------------------------------*/
/* 02. Add TinyMCE Space Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.space', {  
    init : function(ed, url) {  
      ed.addButton('space', {  
        title : 'Add Space',  
        icon  : 'space',
        onclick : function() {  
          ed.selection.setContent('[space height="30"]');
        }
      });
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('space', tinymce.plugins.space);  
})();



/*-----------------------------------------------------------------------------------*/
/* 03. Add TinyMCE Divider Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.divider', {  
    init : function(ed, url) {  
      ed.addButton('divider', {  
        title : 'Add Divider',  
        icon  : 'divider',
        onclick : function() {  
          ed.selection.setContent('[divider style="1,2,3,4" margin="40px 0px 40px 0px"]');
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('divider', tinymce.plugins.divider);  
})();



/*-----------------------------------------------------------------------------------*/
/* 04. Add TinyMCE Headline Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.headline', {  
    init : function(ed, url) {  
      ed.addButton('headline', {  
        title : 'Add Headline',  
        icon  : 'headline',
        onclick : function() {  
          ed.selection.setContent('[headline heading="h1, h2, h3, h4, h5, h6" style="1,2,3,4,5" title="Your Title"]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('headline', tinymce.plugins.headline);  
})();



/*-----------------------------------------------------------------------------------*/
/* 05. Add TinyMCE Accordion Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.accordion', {  
    init : function(ed, url) {  
      ed.addButton('accordion', {  
        title : 'Add Accordion',  
        icon  : 'accordion',
        onclick : function() {  
          ed.selection.setContent('[accordion title="Accordion Title" open="true or false" icon="star"]Your Content goes here...[/accordion]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);  
})();



/*-----------------------------------------------------------------------------------*/
/* 06. Add TinyMCE Tabs Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.tabs', {  
    init : function(ed, url) {  
      ed.addButton('tabs', {  
        title : 'Add Tabs',  
        icon  : 'tabs',
        onclick : function() {  
          ed.selection.setContent('[tabgroup]<br />[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />[tab title="Tab 2" icon="file"]Tab 2 content goes here.[/tab]<br />[tab icon="file"]Tab 3 content goes here.[/tab]<br />[/tabgroup]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();



/*-----------------------------------------------------------------------------------*/
/* 07. Add TinyMCE Styled Table Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.styled_table', {  
    init : function(ed, url) {  
      ed.addButton('styled_table', {  
        title : 'Add Styled Table',  
        icon  : 'styled-table',
        onclick : function() {  
          ed.selection.setContent('[styled_table style="1 or 2"]Insert Table here[/styled_table]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('styled_table', tinymce.plugins.styled_table);  
})();



/*-----------------------------------------------------------------------------------*/
/* 08. Add TinyMCE Google Font Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.googlefont', {  
    init : function(ed, url) {  
      ed.addButton('googlefont', {  
        title : 'Add Googlefont',  
        icon  : 'googlefont',
        onclick : function() {  
          ed.selection.setContent('[googlefont font="ABeeZee" size="40px" margin="10px 0 20px 0"]Your Text...[/googlefont]');  
        }
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('googlefont', tinymce.plugins.googlefont);  
})();



/*-----------------------------------------------------------------------------------*/
/* 09. Add TinyMCE Highlight Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.highlight', {  
    init : function(ed, url) {  
      ed.addButton('highlight', {  
        title : 'Add Highlight',
        icon  : 'highlight',
        onclick : function() {  
          ed.selection.setContent('[highlight style="yellow,blue,green,red,pink" ]Highlight text here...[/highlight]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);  
})();



/*-----------------------------------------------------------------------------------*/
/* 10. Add TinyMCE Icon Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.icon', {  
    init : function(ed, url) {  
      ed.addButton('icon', {  
        title : 'Add Icon',  
        icon  : 'icon',
        onclick : function() {  
          ed.selection.setContent('[icon icon="check" size="small, medium, large" color="#999999" background="#efefef" align="center,left,right" circle="true or false" spin="true or false" rotate="normal"]');
        }
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('icon', tinymce.plugins.icon);  
})();



/*-----------------------------------------------------------------------------------*/
/* 11. Add TinyMCE Buttons
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.buttons', {  
    init : function(ed, url) {  
      ed.addButton('buttons', {  
        title : 'Add Button',  
        icon  : 'buttons',
        onclick : function() {  
          ed.selection.setContent('[buttons link="http://www.google.com" size="small, medium, large" target="_blank or _self" lightbox="true or false" color="black,gray,yellow,orange,red,blue,aqua,green,pink,purple" icon="cog"]Button[/buttons]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('buttons', tinymce.plugins.buttons);  
})();



/*-----------------------------------------------------------------------------------*/
/* 12. Add TinyMCE List Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.list', {  
    init : function(ed, url) {  
      ed.addButton('list', {  
        title : 'Add List',  
        icon  : 'list',
        onclick : function() {  
          ed.selection.setContent('[list border="true" border_style="solid"][list_item icon="glass"]glass[/list_item][list_item icon="music"]music[/list_item][list_item icon="search"]search[/list_item][list_item icon="envelope"]envelope[/list_item][/list]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('list', tinymce.plugins.list);  
})();



/*-----------------------------------------------------------------------------------*/
/* 13. Add TinyMCE Box Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.box', {  
    init : function(ed, url) {  
      ed.addButton('box', {  
        title : 'Add Box',  
        icon  : 'box',
        onclick : function() {  
          ed.selection.setContent('[box img="" url="" border="true"]Box text here...[/box]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('box', tinymce.plugins.box);  
})();



/*-----------------------------------------------------------------------------------*/
/* 14. Add TinyMCE Icon Box Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.icon_box', {  
    init : function(ed, url) {  
      ed.addButton('icon_box', {  
        title : 'Add Icon Box',  
        icon  : 'icon-box',
        onclick : function() {  
          ed.selection.setContent('[icon_box icon="check" icon_color="#000000" title="Icon Box Title"]Icon Box text here...[/icon_box]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('icon_box', tinymce.plugins.icon_box);  
})();



/*-----------------------------------------------------------------------------------*/
/* 15. Add TinyMCE Video Embed Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.video_embed', {  
    init : function(ed, url) {  
      ed.addButton('video_embed', {  
        title : 'Add Video',  
        icon  : 'video-embed',
        onclick : function() {  
          ed.selection.setContent('[video_embed type="youtube, vimeo, dailymotion, niconico" id="Enter video ID (eg. 8F7UOBIT4Vk)"]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('video_embed', tinymce.plugins.video_embed);  
})();



/*-----------------------------------------------------------------------------------*/
/* 16. Add TinyMCE Responsive Image Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.responsive_image', {  
    init : function(ed, url) {  
      ed.addButton('responsive_image', {  
        title : 'Add Responsive Image',  
        icon  : 'responsive-image',
        onclick : function() {  
          ed.selection.setContent('[responsive_image]IMAGE HERE[/responsive_image]');  
        }
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('responsive_image', tinymce.plugins.responsive_image);  
})();



/*-----------------------------------------------------------------------------------*/
/* 17. Add TinyMCE Google Maps Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.google_maps', {  
    init : function(ed, url) {  
      ed.addButton('google_maps', {  
        title : 'Add Google Maps',  
        icon  : 'google-maps',
        onclick : function() {  
          ed.selection.setContent('[google_maps w="600" h="400" style="full, standard" z="16" marker="yes" infowindow="Hello World!" infowindowdefault="yes or no" hidecontrols="true or false" address="New York"]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('google_maps', tinymce.plugins.google_maps);  
})();



/*-----------------------------------------------------------------------------------*/
/* 18. Add TinyMCE Recent Posts Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.recent_posts', {  
    init : function(ed, url) {  
      ed.addButton('recent_posts', {  
        title : 'Add Recent Posts',  
        icon  : 'recent-posts',
        onclick : function() {  
          ed.selection.setContent('[recent_posts title="Recent Posts" category="" number="5" date="yes" thumbnail="no" excerpt="no" excerpt_length="60" read_more="yes"]');
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('recent_posts', tinymce.plugins.recent_posts);  
})();



/*-----------------------------------------------------------------------------------*/
/* 19. Add TinyMCE Recent News Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.recent_news', {  
    init : function(ed, url) {  
      ed.addButton('recent_news', {  
        title : 'Add Recent News',  
        icon  : 'recent-news',
        onclick : function() {  
          ed.selection.setContent('[recent_news title="Recent News" category="" number="5" date="yes" thumbnail="no" excerpt="no" excerpt_length="60" read_more="yes"]');
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('recent_news', tinymce.plugins.recent_news);  
})();



/*-----------------------------------------------------------------------------------*/
/* 20. Add TinyMCE Recent Portfolio Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.recent_portfolio', {  
    init : function(ed, url) {  
      ed.addButton('recent_portfolio', {  
        title : 'Add Recent Portfolio',  
        icon  : 'recent-portfolio',
        onclick : function() {  
          ed.selection.setContent('[recent_portfolio title="Recent Portfolio" category="" number="5" show_title="yes"]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('recent_portfolio', tinymce.plugins.recent_portfolio);
})();



/*-----------------------------------------------------------------------------------*/
/* 21. Add TinyMCE Recent Event Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.recent_event', {  
    init : function(ed, url) {  
      ed.addButton('recent_event', {  
        title : 'Add Recent Event',  
        icon  : 'recent-event',
        onclick : function() {  
          ed.selection.setContent('[recent_event title="Recent Event" category="" number="5" date="yes" thumbnail="no" excerpt="no" excerpt_length="60" read_more="yes"]');
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('recent_event', tinymce.plugins.recent_event);  
})();



/*-----------------------------------------------------------------------------------*/
/* 22. Add TinyMCE Blockquote Button
/*-----------------------------------------------------------------------------------*/
(function() {  
  tinymce.create('tinymce.plugins.blockquote', {  
    init : function(ed, url) {  
      ed.addButton('blockquote', {  
        title : 'Add Blockquote',  
        onclick : function() {  
          ed.selection.setContent('[blockquote]Quote goes here...[/blockquote]');  
        }  
      });  
    },  
    createControl : function(n, cm) {  
      return null;  
    },  
  });  
  tinymce.PluginManager.add('blockquote', tinymce.plugins.blockquote);  
})();
