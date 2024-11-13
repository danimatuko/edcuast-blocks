import { registerBlockType } from "@wordpress/blocks";
import {
    InspectorControls,
    RichText,
    useBlockProps,
} from "@wordpress/block-editor";
import { ColorPalette, PanelBody } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import "./main.css";

registerBlockType(block.name, {
    edit({ attributes, setAttributes }) {
        const { title, underline_color } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps}>
                <InspectorControls key="setting">
                    <PanelBody title={__("Colors", "educast-blocks")}>
                        <ColorPalette
                            colors={[
                                { name: "Red", color: "#f87171" },
                                { name: "Indigo", color: "#818cf8" },
                            ]}
                            value={underline_color}
                            onChange={(newVal) => setAttributes({ underline_color: newVal })}
                        />
                    </PanelBody>
                </InspectorControls>

                <RichText
                    tagName="h2"
                    className="fancy-header"
                    value={title}
                    onChange={(value) => setAttributes({ title: value })}
                    allowedFormats={["core/bold", "core/link"]}
                />
            </div>
        );
    },

    save({ attributes }) {
        const { underline_color } = attributes;
        const blockProps = useBlockProps.save({
            className: "fancy-header mb-5",
            style: {
                "background-image": `linear-gradient(transparent,transparent), linear-gradient(${underline_color},${underline_color})`,
            },
        });

        const { title } = attributes;
        return <RichText.Content {...blockProps} tagName="h2" value={title} />;
    },
});
