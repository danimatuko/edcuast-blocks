import { registerBlockType } from "@wordpress/blocks";
import { PanelBody, TextControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import {
    useBlockProps,
    InspectorControls,
    PanelColorSettings,
} from "@wordpress/block-editor";
import block from "./block.json";
import "./main.css";

registerBlockType(block.name, {
    icon: "search",
    edit: ({ attributes, setAttributes }) => {
        const { formColor, placeholder } = attributes;

        // Use block props for styling and accessibility
        const blockProps = useBlockProps({
            className:
                "bg-white my-5 flex px-1 py-1 rounded-full border border-blue-500 overflow-hidden max-w-md mx-auto font-sans",
            style: { borderColor: formColor },
        });

        // Handlers for attribute changes
        const onColorChange = (newColor) => setAttributes({ formColor: newColor });
        const onPlaceholderChange = (value) =>
            setAttributes({ placeholder: value });

        return (
            <div>
                {/* Inspector controls for block settings */}
                <InspectorControls>
                    <PanelColorSettings
                        title={__("Colors", "educast-blocks")}
                        colorSettings={[
                            {
                                label: __("Form Color", "educast-blocks"),
                                value: formColor,
                                onChange: onColorChange,
                            },
                        ]}
                    />
                    <PanelBody title={__("Placeholder", "educast-blocks")}>
                        <TextControl
                            label={__("Placeholder", "educast-blocks")}
                            value={placeholder}
                            onChange={onPlaceholderChange}
                        />
                    </PanelBody>
                </InspectorControls>

                {/* Preview of the search form in the editor */}
                <form {...blockProps} role="search" method="get" action="">
                    <input
                        type="search"
                        name="s" // The search parameter for WordPress
                        placeholder={placeholder || __("Search...", "educast-blocks")} // Fallback placeholder
                        className="w-full outline-none bg-white pl-4 text-sm"
                        required // Required field for user input
                    />
                    <button
                        type="submit" // Button type to submit the form
                        className="bg-blue-600 hover:bg-blue-700 transition-all text-white text-sm rounded-full px-5 py-2.5"
                        style={{ backgroundColor: formColor }} // Dynamic button color
                    >
                        {__("Search", "educast-blocks")}
                    </button>
                </form>
            </div>
        );
    },
});
