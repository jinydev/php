# 설정
config 옵션을 통하여 컴포저의 설정값을 변경할 수 있습니다.

## 설정보기
현재의 컴포저 설정을 확인을 할때에는 `--list` 옵션을 사용합니다.

```
composer config --list
```

명령을 입력하면 다음과 같이 유사한 결과가 출력 됩니다.
```
$ composer config --list
[repositories.packagist.org.type] composer
[repositories.packagist.org.url] https?://repo.packagist.org
[repositories.packagist.org.allow_ssl_downgrade] true       
[process-timeout] 300
[use-include-path] false
[preferred-install] auto
[notify-on-install] true
[github-protocols] [https, ssh]
[vendor-dir] vendor (D:\jiny\jiny_v2/vendor)
[bin-dir] {$vendor-dir}/bin (D:\jiny\jiny_v2/vendor/bin)
[cache-dir] C:/Users/infoh/AppData/Local/Composer
[data-dir] C:/Users/infoh/AppData/Roaming/Composer
[cache-files-dir] {$cache-dir}/files (C:/Users/infoh/AppData/Local/Composer/files)
[cache-repo-dir] {$cache-dir}/repo (C:/Users/infoh/AppData/Local/Composer/repo)
[cache-vcs-dir] {$cache-dir}/vcs (C:/Users/infoh/AppData/Local/Composer/vcs)
[cache-ttl] 15552000
[cache-files-ttl] 15552000
[cache-files-maxsize] 300MiB (314572800)
[bin-compat] auto
[discard-changes] false
[autoloader-suffix]
[sort-packages] false
[optimize-autoloader] false
[classmap-authoritative] false
[apcu-autoloader] false
[prepend-autoloader] true
[github-domains] [github.com]
[bitbucket-expose-hostname] true
[disable-tls] false
[secure-http] true
[cafile]
[capath]
[github-expose-hostname] true
[gitlab-domains] [gitlab.com]
[store-auths] prompt
[archive-format] tar
[archive-dir] .
[htaccess-protect] true
[home] C:/Users/infoh/AppData/Roaming/Composer
```

여러 종류의 환경 설정이 되어 있는 것을 확인할 수 있습니다.

## 전역설정
전역으로 설정된 컴포저의 설정값을 확인하기 위해서는 `global` 옵션을 추가하면 됩니다.

```
composer global config --list
```


## 설정하기
설정값은 키:값 형태의 한쌍으로 설정을 하게 됩니다.

```
composer config 키 값
```



