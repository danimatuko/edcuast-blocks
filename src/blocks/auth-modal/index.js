import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './main.css'
import block from './block.json'
import { login } from "@wordpress/icons";

registerBlockType(block.name, {
    icon: login,
    edit({ attributes, setAttributes }) {
        const { showRegister } = attributes;
        const blockProps = useBlockProps();

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('General', 'educast-blocks')}>
                        <ToggleControl
                            __nextHasNoMarginBottom
                            label="Show login/register modal"
                            help={
                                showRegister
                                    ? 'Enabled'
                                    : 'disabled'
                            }
                            checked={showRegister}
                            onChange={(showRegister) => setAttributes({ showRegister })}
                        />
                    </PanelBody>
                </InspectorControls>

                {showRegister &&
                    <div {...blockProps}>
                        {__('This block is not previewable from the editor. View your site for a live demo.', 'udemy-plus')}
                    </div>
                }
            </>
        );
    }
});
