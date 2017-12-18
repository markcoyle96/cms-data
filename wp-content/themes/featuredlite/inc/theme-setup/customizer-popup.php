<div id="popup_homepage" style="display:none; ">
    <div class="container-popup">
        <div>
            <div class="popup_cp_column">
                <h3 class="popup_title"><?php esc_html_e('Please Install the ThemeHunk customizer WordPress Plugin.Plugin will enable below features in the theme. ', 'featuredlite') ?></h3>
                <h4><?php esc_html_e('Salient Features -', 'featuredlite'); ?></h4>
                <ul class="popup-features-list">
                    <li><?php esc_html_e('Hero background slider', 'featuredlite'); ?></li>
                    <li><?php esc_html_e('Advanced Live Customizer', 'featuredlite'); ?></li>
                    <li><?php esc_html_e('Unlimited Front Page Section (Services,Testimonial,Our Team)', 'featuredlite'); ?></li>
                    <li><?php esc_html_e('Section enable/disable option', 'featuredlite'); ?></li>
                    <li><?php esc_html_e('Powerful Animation and parallax effect', 'featuredlite'); ?></li>
                    <li><?php esc_html_e('Unlimited color options', 'featuredlite'); ?></li>
                </ul>
            </div>
        </div>
        <div class="footer">
            <label class="disable-popup-cb">
                <input type="checkbox" id="disable-popup-cb"/>
                <?php esc_html_e("Don't show this popup in refresh page", 'featuredlite'); ?>
            </label>
            <a class="button-link-cb" onclick="tb_remove();"> <?php esc_html_e('Disable PoPuP', 'featuredlite') ?> </a>
            <?php 
                $obj = New Featuredlite_Popup();
            echo $obj->active_plugin(); ?>
        </div>
    </div>
</div>