<?php
/**
 * View: Map Icon
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/icons/map.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @var array<string> $classes Additional classes to add to the svg icon.
 *
 * @version 4.12.14
 *
 */
$svg_classes = [ 'tribe-common-c-svgicon', 'tribe-common-c-svgicon--map' ];

if ( ! empty( $classes ) ) {
	$svg_classes = array_merge( $svg_classes, $classes );
}
?>
<svg <?php tribe_classes( $svg_classes ); ?> viewBox="0 0 19 18" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.308 7.726c0 2.27-3.66 6.807-3.816 6.999-.04.05-.1.078-.161.078a.208.208 0 01-.16-.078c-.157-.192-3.817-4.729-3.817-6.999 0-2.333 1.784-4.232 3.977-4.232 2.193 0 3.977 1.899 3.977 4.232zm-3.977-3.78c-1.959 0-3.552 1.696-3.552 3.78 0 1.849 2.839 5.59 3.552 6.5.713-.91 3.552-4.652 3.552-6.5 0-2.084-1.593-3.78-3.552-3.78z" class="tribe-common-c-svgicon__svg-fill"/><path d="M9.492 14.725l.271.22-.271-.22zm-.322 0l-.272.22.272-.22zm.16-.499l-.275.216.276.352.275-.352-.275-.216zm.434.72a35.15 35.15 0 001.988-2.75c.472-.729.944-1.53 1.3-2.299.35-.759.606-1.525.606-2.171h-.7c0 .49-.201 1.141-.542 1.878-.336.726-.789 1.497-1.251 2.21a34.437 34.437 0 01-1.945 2.69l.544.441zm-.433.207c.172 0 .329-.08.432-.207l-.543-.442a.143.143 0 01.11-.05v.7zm-.433-.207c.104.128.261.207.433.207v-.7c.048 0 .088.023.11.051l-.543.442zm-3.894-7.22c0 .646.256 1.412.606 2.171.356.769.828 1.57 1.3 2.298a35.153 35.153 0 001.988 2.75l.544-.44a34.442 34.442 0 01-1.945-2.69c-.462-.714-.915-1.485-1.251-2.211-.34-.737-.542-1.389-.542-1.878h-.7zM9.33 3.144c-2.407 0-4.327 2.076-4.327 4.582h.7c0-2.161 1.647-3.882 3.627-3.882v-.7zm4.327 4.582c0-2.506-1.92-4.582-4.327-4.582v.7c1.98 0 3.627 1.721 3.627 3.882h.7zm-7.53 0c0-1.912 1.458-3.43 3.203-3.43v-.7c-2.172 0-3.902 1.873-3.902 4.13h.7zm3.478 6.285a35.082 35.082 0 01-2.022-2.868 15.842 15.842 0 01-1.03-1.891c-.273-.613-.425-1.139-.425-1.526h-.7c0 .537.202 1.173.485 1.81.286.645.672 1.33 1.076 1.977a35.767 35.767 0 002.065 2.93l.551-.432zm2.927-6.285c0 .387-.153.912-.425 1.525a15.841 15.841 0 01-1.03 1.891 35.097 35.097 0 01-2.023 2.869l.551.431c.36-.46 1.257-1.633 2.065-2.93.405-.647.79-1.331 1.077-1.977.283-.636.485-1.272.485-1.809h-.7zm-3.202-3.43c1.745 0 3.202 1.518 3.202 3.43h.7c0-2.257-1.73-4.13-3.902-4.13v.7z" class="tribe-common-c-svgicon__svg-fill"/><path fill-rule="evenodd" clip-rule="evenodd" d="M9.331 6.321c.742 0 1.346.634 1.346 1.414 0 .78-.604 1.414-1.346 1.414-.742 0-1.346-.635-1.346-1.414 0-.78.604-1.414 1.346-1.414zm0 .267c-.602 0-1.092.514-1.092 1.147 0 .632.49 1.147 1.092 1.147.602 0 1.093-.515 1.093-1.147 0-.633-.49-1.147-1.093-1.147z" class="tribe-common-c-svgicon__svg-fill"/><path d="M11.027 7.735c0-.957-.744-1.764-1.696-1.764v.7c.533 0 .996.461.996 1.064h.7zM9.331 9.499c.952 0 1.696-.808 1.696-1.764h-.7c0 .602-.463 1.064-.996 1.064v.7zM7.635 7.735c0 .956.745 1.764 1.696 1.764v-.7c-.533 0-.996-.462-.996-1.064h-.7zM9.33 5.97c-.951 0-1.696.807-1.696 1.764h.7c0-.603.463-1.064.996-1.064v-.7zM8.59 7.735c0-.456.349-.797.742-.797v-.7c-.812 0-1.442.687-1.442 1.497h.7zm.742.797c-.393 0-.742-.341-.742-.797h-.7c0 .81.63 1.497 1.442 1.497v-.7zm.742-.797c0 .455-.349.797-.742.797v.7c.812 0 1.443-.688 1.443-1.497h-.7zm-.742-.797c.393 0 .742.341.742.797h.7c0-.81-.63-1.497-1.442-1.497v.7z" class="tribe-common-c-svgicon__svg-fill"/><path fill-rule="evenodd" clip-rule="evenodd" d="M.363.431V17.57c0 .238.163.431.363.431H18c.201 0 .364-.193.364-.431V.43c0-.238-.163-.431-.364-.431H.726c-.2 0-.363.193-.363.431zm.99.808h15.995v2.314H1.354V1.24zm0 2.314h15.995v13.204H1.354V3.553z" class="tribe-common-c-svgicon__svg-fill"/></svg>