{{-- IMPORTANT VARIABLE --}}
<?php
//shortlisting app()->getLocal
$appLocale = app()->getLocale();
?>
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span
            class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{ GoogleTranslate::trans('Done by', $appLocale) }}
            <a href="" target="_blank">Philippe Tsongo</a> </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright ©2023 </span>
    </div>
</footer>
