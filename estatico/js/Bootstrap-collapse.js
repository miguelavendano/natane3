/ * ================================================ =============
 * Bootstrap-collapse.js v2.2.2
 * Http://twitter.github.com/bootstrap/javascript.html # colapso
 * ================================================= ============
 * Copyright 2012 Twitter, Inc.
 *
 * Licenciado bajo la licencia Apache, versión 2.0 (la "Licencia");
 * Usted no puede utilizar este archivo excepto en conformidad con la Licencia.
 * Usted puede obtener una copia de la Licencia en
 *
 * Http://www.apache.org/licenses/LICENSE-2.0
 *
 * A menos que requerido por la ley aplicable o se acuerde por escrito, el software
 * Distribuido bajo la licencia se distribuye "TAL CUAL",
 * SIN GARANTÍAS NI CONDICIONES DE NINGÚN TIPO, ya sea expresa o implícita.
 * Consulte la licencia para el idioma específico que rige los permisos y
 * Limitaciones en la licencia.
 * ================================================= =========== * /


! Function ($) {

  "Use strict"; / / jshint; _;


 / * DEFINICIÓN DE COLAPSO DE CLASE PÚBLICA
  * ================================ * /

  var Collapse = function (elemento, options) {
    esto. $ elemento = $ (elemento)
    this.options = $. extend ({} $. fn.collapse.defaults, opciones)

    si (this.options.parent) {
      esto. $ matriz = $ (this.options.parent)
    }

    && this.options.toggle this.toggle ()
  }

  Collapse.prototype = {

    constructor: Collapse

  , Dimensión: function () {
      var = hasWidth esto. element.hasClass $ ('width')
      volver hasWidth? 'Width': 'height'
    }

  , Show: function () {
      dimensión var
        , Desplácese
        , Activos
        , HasData

      if (this.transitioning) return

      dimensión this.dimension = ()
      . scroll = $ camelCase (. ['scroll', dimensión] join ('-'))
      = Esta activos. $ && padres esto. parent.find $ ('>. acordeón grupo>. en')

      if (activos actives.length &&) {
        HasData = actives.data ('colapso')
        if (&& HasData hasData.transitioning) return
        actives.collapse ('hide')
        HasData | | actives.data ('colapso', null)
      }

      esto. $ element [dimensión] (0)
      this.transition ('addClass', $. Evento ('show'), 'se muestra')
      $. && Support.transition esto. $ Element [dimensión] (esto. $ element [0] [scroll])
    }

  , Ocultar: function () {
      dimensión var
      if (this.transitioning) return
      dimensión this.dimension = ()
      this.reset (esto. $ element [dimensión] ())
      this.transition ('removeClass', $. Evento ('hide'), 'oculto')
      esto. $ element [dimensión] (0)
    }

  , Reset: function (tamaño) {
      var = dimensión this.dimension ()

      esto. $ element
        . RemoveClass ('colapso')
        [Dimensión] (tamaño | | 'auto')
        [0]. OffsetWidth

      este elemento. $ [size! == null? 'AddClass': 'removeClass'] ('colapso')

      devuelva este
    }

  , La transición: function (método, startEvent, completeEvent) {
      var que esta =
        , Completa = function () {
            if (startEvent.type == 'show') that.reset ()
            that.transitioning = 0
            que. $ element.trigger (completeEvent)
          }

      este element.trigger. $ (startEvent)

      if (startEvent.isDefaultPrevented ()) retorno

      this.transitioning = 1

      esto. $ element [método] ('en')

      $. && Support.transition esto. Element.hasClass $ ('colapso')?
        estos $ element.one ($ support.transition.end, completo.).:
        completar ()
    }

  , Toggle: function () {
      este [esta element.hasClass. $ ('a')? 'Ocultar': 'show'] ()
    }

  }


 / * DEFINICIÓN DE COLAPSO DE PLUGIN
  * ========================== * /

  var edad = $. fn.collapse

  $. Fn.collapse = function (opcional) {
    volver this.each (function () {
      var $ this = $ (this)
        , Data = $ this.data ('colapso')
        , Options = typeof option == 'objeto' && opción
      if (! data) $ this.data ('colapso', (datos = new Collapse (esto, opciones)))
      if (typeof option == 'string') de datos [opción] ()
    })
  }

  $. Fn.collapse.defaults = {
    toggle: true
  }

  $. Fn.collapse.Constructor = Collapse


 / * NO COLAPSO DE CONFLICTOS
  * ==================== * /

  $. Fn.collapse.noConflict = function () {
    $. Fn.collapse = viejo
    devuelva este
  }


 / * COLAPSO DE DATOS-API
  * ================= * /

  $ (Document). Sobre ('click.collapse.data-api', '[data-toggle = colapso]', function (e) {
    var $ this = $ (this), href
      , Target = $ this.attr ('data-target')
        | | E.preventDefault ()
        | | (Href = $ this.attr ('href')) && href.replace (.? / * (= # [^ \ S] + $) /,'') / / tira para ie7
      , Opción = $ (TARGET). Datos ('colapso')? 'Toggle': $ this.data ()
    $ This hasClass [$ (objetivo). ('En')? 'AddClass': 'removeClass'] ('derrumbó')
    Colapso $ (objetivo). (Opcional)
  })

} (Window.jQuery);