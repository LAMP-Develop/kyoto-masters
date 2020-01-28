(function() {
  tinymce.create('tinymce.plugins.example_shortcode_button', {
    init: function(ed, url) {
      ed.addButton('nlink', {
        title: '内部リンク',
        icon: 'code',
        cmd: 'cmd'
      });

      ed.addCommand('cmd', function() {
        var selected_text = ed.selection.getContent(),
          return_text = '[nlink url="'+selected_text+'"]';
        ed.execCommand('mceInsertContent', 0, return_text);
      });
    },
    createControl: function(n, cm) {
      return null;
    },
  });
  tinymce.PluginManager.add('example_shortcode_button_plugin', tinymce.plugins.example_shortcode_button);
})();