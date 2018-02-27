<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Front_View_List_LC_HC_MVC
{
	public function render( $params = array() )
	{
		$style = array_key_exists('list-style', $params) ? $params['list-style'] : NULL;
		$holder_id = 'hclc_list';
		$div = $this->app->make('/html/element')->tag('div')
			->add_attr('id', $holder_id)
			->add_attr('class', 'hc-mb3-xs')
			->add_attr('class', 'hc-relative')

			->add_attr('style', $style)
			;

		$div
			->add_attr('style', 'display: none;')
			;

		$app_settings = $this->app->make('/app/settings');
		$template = $app_settings->get('front_list:template');

		$template = $this->app->make('/html/element')->tag('script')
			->add_attr('type', 'text/template')
			->add_attr('id', 'hclc_list_template')
			->add( $template )
			;

		$no_results_template = array();
		$no_results_template[] = '<div class="hc-p2 hc-border hc-rounded">';
		$no_results_template[] = HCM::__('No Results');
		$no_results_template[] = '</div>';
		$no_results_template = join("\n", $no_results_template);

		$no_results_template = $this->app->make('/html/element')->tag('script')
			->add_attr('type', 'text/template')
			->add_attr('id', 'hclc_list_template_no_results')
			->add( $no_results_template )
			;

		$allowed_params = array(
			'group'		=> array('country', 'state', 'city', 'zip'),
			);

		foreach( $params as $k => $v ){
			$k = strtolower($k);
			$v = strtolower($v);

			if( isset($allowed_params[$k]) ){
				if( ! in_array($v, $allowed_params[$k]) ){
					continue;
				}
			}

			$div
				->add_attr('data-' . $k, $v)
				;
		}

		$out = $this->app->make('/html/element')->tag(NULL)
			->add( $div )
			->add( $template )
			->add( $no_results_template )
			;

		return $out;
	}
}