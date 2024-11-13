import { registerBlockType } from "@wordpress/blocks";
import block from "./block.json";
import { __ } from "@wordpress/i18n";
import "./main.css";
import { PanelBody, ToggleControl } from "@wordpress/components";
import { title } from "@wordpress/icons";
import {
    useBlockProps,
    RichText,
    InspectorControls,
} from "@wordpress/block-editor";

registerBlockType(block.name, {
    icon: title,
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps({
            className: "text-4xl text-white text-center py-5 bg-gray-700 mb-5", // Custom styles here if you need
        });
        const { showCategory, content = "" } = attributes;

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__("General", "educast-blocks")}>
                        <ToggleControl
                            label={__("Show Category", "educast-blocks")}
                            help={
                                showCategory
                                    ? __("Show Category", "educast-blocks")
                                    : __("Show custom text", "educast-blocks")
                            }
                            checked={showCategory}
                            onChange={(showCategory) => setAttributes({ showCategory })}
                        />
                    </PanelBody>
                </InspectorControls>
                {showCategory ? (
                    <h1 {...blockProps}>{__("Some Heading", "educast-blocks")}</h1>
                ) : (
                    <div {...blockProps}>
                        <RichText
                            tagName="h1"
                            value={content}
                            onChange={(content) => setAttributes({ content })}
                            placeholder={__("Heading...", "educast-blocks")}
                        />
                    </div>
                )}
            </>
        );
    },
});
