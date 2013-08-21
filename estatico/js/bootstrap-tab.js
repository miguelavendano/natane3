/ * ================================================ ========
 * Bootstrap-tab.js v2.2.2
 * Http://twitter.github.com/bootstrap/javascript.html pestañas #
 * ================================================= =======
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
 * ================================================= ======= * /


! Function ($) {

  "Use strict"; / / jshint; _;


 / TAB * Definición de clase
  * ==================== * /

  var Tab = function (elemento) {
    this.element = $ (elemento)
  }

  Tab.prototype = {

    constructor: Tab

  , Show: function () {
      var $ this this.element =
        , $ Ul = $ this.closest ('ul:. No (dropdown-menú)')
        , Selector = $ this.attr ('data-target')
        , Previo
        , $ Target
        , E

      if (! selector) {
        selector = $ this.attr ('href')
        selector selector selector.replace = && (/. * (? = # [^ \ s] * $) /,'') / / tira para ie7
      }

      if ($ this.parent ('li'). hasClass ("activo")) return

      anterior = $ ul.find ('activo:. pasado a') [0]

      e = $. Evento ('show', {
        relatedTarget: anterior
      })

      $ This.trigger (e)

      if (e.isDefaultPrevented ()) retorno

      $ Target = $ (selector)

      this.activate ($ this.parent ('li'), $ ul)
      this.activate ($ target, $ target.parent (), function () {
        $ This.trigger ({
          tipo: "Aquí sólo '
        , RelatedTarget: anterior
        })
      })
    }

  , Activar: function (elemento contenedor, callback) {
      var $ = activo container.find ('>. activo ")
        , La transición callback =
            && $. Support.transition
            Active.hasClass && $ ('fade')

      función next () {
        $ Activo
          . RemoveClass ("activo")
          . Find ('>. Dropdown-menú>. Activo ")
          . RemoveClass ("activo")

        element.addClass ("activo")

        if (transición) {
          elemento [0]. offsetWidth / / reflow para la transición
          element.addClass ('en')
        } Else {
          element.removeClass ('fade')
        }

        if (element.parent ('. dropdown-menú')) {
          element.closest ('li.dropdown'). addClass ("activo")
        }

        && callback callback ()
      }

      transición?
        $ Active.one ($ support.transition.end, a continuación.):
        next ()

      $ Active.removeClass ('en')
    }
  }


 / * TAB DEFINICIÓN PLUGIN
  * ===================== * /

  var edad = $. fn.tab

  $. Fn.tab = function (opcional) {
    volver this.each (function () {
      var $ this = $ (this)
        , Data = $ this.data ('tab')
      if (! data) $ this.data ('tab', (datos = new Tab (este)))
      if (typeof option == 'string') de datos [opción] ()
    })
  }

  $. Fn.tab.Constructor = Tab


 / * TAB NO CONFLICTO
  * =============== * /

  $. Fn.tab.noConflict = function () {
    $. Fn.tab = viejo
    devuelva este
  }


 / * TAB DATOS-API
  * ============ * /

  $ (Document). Sobre ('click.tab.data-api', '[data-toggle = "ficha"], [data-toggle = "píldora"]', function (e) {
    e.preventDefault ()
    Cuenta de $ (this). ('Show')
  })

} (Window.jQuery);