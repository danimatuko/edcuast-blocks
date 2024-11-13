import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
//import icons from '../../icons.js'
import './main.css'
import block from './block.json'


registerBlockType(block.name, {
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        const { showAuth } = attributes

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('General', 'educast-blocks')}>
                        <ToggleControl
                            __nextHasNoMarginBottom
                            label="Show login/register link"
                            help={
                                showAuth
                                    ? 'Enable'
                                    : 'Disable'
                            }
                            checked={showAuth}
                            onChange={(showAuth) => {
                                setAttributes({ showAuth });
                            }}

                        />
                    </PanelBody>
                </InspectorControls>

                {showAuth &&
                    <div {...blockProps}>
                        <div className="wp-block-udemy-plus-header-tools">
                            <a className="signin-link open-modal" href="#signin-modal">
                                <div className="signin-icon">
                                    <i className="bi bi-person-circle"></i>
                                </div>
                                <div className="signin-text">
                                    <small>Hello, Sign in</small>
                                    My Account
                                </div>
                            </a>
                        </div>
                    </div>
                }
            </>
        )
    },
})
