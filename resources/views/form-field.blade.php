<input type="hidden"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       @if($row->required == 1) required @endif
       step="any"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">

<div id="{{ $row->field }}-editor" style="border: 1px solid #e4eaec; border-radius: 3px"></div>

<script src="/admin/assets/js/voyager-blocks-editor/editor.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/header.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/link.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/image.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/list.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/code.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/raw.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/quote.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/table.js"></script>
<script src="/admin/assets/js/voyager-blocks-editor/main.js"></script>

<script>
    window.storageUrl = "{{ Storage::url(null) }}";

    window.onload = function () {
        var data = {};

        try {
            data = JSON.parse($('input[name={{ $row->field }}]').val());
        } catch {}

        const editor = new EditorJS({
            holderId: '{{ $row->field }}-editor',
            tools: {
                header: Header,
                link: LinkTool,
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: '/admin/media/upload'
                        },
                        field: 'file',
                        additionalRequestData: {
                            _token: '{{ csrf_token() }}',
                            upload_path: '/{{ $row->field }}',
                            filename: null
                        }
                    }
                },
                list: List,
                raw: RawTool,
                code: CodeTool,
                quote: Quote,
                table: Table
            },
            data: data,

            onChange: function () {
                editor.save().then((outputData) => {
                    $('input[name={{ $row->field }}]').val(JSON.stringify(outputData));
                });
            }
        });
    }
</script>
