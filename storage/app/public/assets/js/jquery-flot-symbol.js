!function(o){function n(o,n,t){var i={square:function(o,n,t,i,a){var s=i*Math.sqrt(Math.PI)/2;o.rect(n-s,t-s,s+s,s+s)},diamond:function(o,n,t,i,a){var s=i*Math.sqrt(Math.PI/2);o.moveTo(n-s,t),o.lineTo(n,t-s),o.lineTo(n+s,t),o.lineTo(n,t+s),o.lineTo(n-s,t)},triangle:function(o,n,t,i,a){var s=i*Math.sqrt(2*Math.PI/Math.sin(Math.PI/3)),e=s*Math.sin(Math.PI/3);o.moveTo(n-s/2,t+e/2),o.lineTo(n+s/2,t+e/2),a||(o.lineTo(n,t-e/2),o.lineTo(n-s/2,t+e/2))},cross:function(o,n,t,i,a){var s=i*Math.sqrt(Math.PI)/2;o.moveTo(n-s,t-s),o.lineTo(n+s,t+s),o.moveTo(n-s,t+s),o.lineTo(n+s,t-s)}},a=n.points.symbol;i[a]&&(n.points.symbol=i[a])}function t(o){o.hooks.processDatapoints.push(n)}o.plot.plugins.push({init:t,name:"symbols",version:"1.0"})}(jQuery);