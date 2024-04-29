<template>
  <div class="bg-white shadow p-4 mt-4 mb-6">
    <div class="mb-3">
      <span class="font-bold text-2xl">پیش نویس مکتوب</span>
    </div>
    <ckeditor
      :editor="editor"
      dir="rtl"
      v-model="editData"
      :config="editConfig"
    >
    </ckeditor>
    <button @click="showAlert">Alert</button>
    <!-- <footer class="bg-gray-100 py-4 md:flex gap-5">
      <button
        type="submit"
        :disabled="documentStore.loading"
        :class="[
          documentStore.loading === true
            ? 'bg-indigo-400 mr-10 text-white py-2 px-6 cursor-not-allowed rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500'
            : 'bg-indigo-600 mr-10 text-white py-2 px-6 cursor-pointer rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500',
        ]"
      >
        <span v-if="documentStore.loading === true">
          <svg
            class="animate-spin -ml-1 h-5 w-5 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            ></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
        </span>
        <span v-else> ثبت </span>
      </button>
      <router-link
        :to="{ name: 'app.teacher.list' }"
        class="bg-white shadow py-2 px-5 cursor-pointer rounded-lg focus:ring focus:ring-offset-2 focus:ring-red-400"
        >لغو ثبت</router-link
      >
    </footer> -->
  </div>
</template>


<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
// import { Alignment } from "@ckeditor/ckeditor5-alignment";
import Swal from "sweetalert2";
export default (await import("vue")).defineComponent({
  data() {
    return {
      editor: ClassicEditor,
      editData: "",
      editConfig: {
        // plugins: [Alignment],
        toolbar: [
          "heading",
          "|",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "|",
          "outdent",
          "indent",
          "|",
          "imageUpload",
          "blockQuote",
          "insertTable",
          "mediaEmbed",
          "undo",
          "redo",
          "|",
          "fontColor",
          "fontBackgroundColor",
          "fontSize",
          "fontFamily",
          "highlight",
          "|",
          "alignment:left",
          "alignment:right",
          "alignment:center",
          "alignment:justify",
          "|",
          "subscript",
          "superscript",
          "|",
          "strikethrough",
          "underline",
          "code",
          "codeBlock",
          "|",
          "specialCharacters",
          "mathType",
          "chemType",
          "|",
          "removeFormat",
          "htmlEmbed",
          "horizontalLine",
          "pageBreak",
          "|",
          "sourceEditing",
        ],
      },
    };
  },

  methods: {
    showAlert() {
      Swal.fire({
        title: "آیا شما مطمین هستید",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "بلی حذف شود!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Deleted!", "فایل موفقانه حذف شد.", "success");
        }
      });
    },
  },
});
</script>

<style>
.ck-content {
  resize: both !important; /* or horizontal, vertical */
  min-height: 200px;
  max-width: inherit !important;
  direction: rtl !important;
}
</style>
