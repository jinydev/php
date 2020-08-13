# 페키지 자동업데이트
---
컴포저 패키지는 깃허브와 같은 깃 저장소와 연계되어 있습니다.  
소스코드가 깃을 통하여 업데이트가 될 경우 자동으로 컴포저의 패키지 버젼도 업데이트를 하실 수 있습니다.

컴포저는 업데이트를 위한 몇가지 방법들을 제공합니다.

<br>
## 깃허브 훅(hook)
---
Packagist의 서비스 훅을 활성화하면 GitHub으로 푸시 할 때마다 항상 컴포저 패키지가 자동으로 즉시 업데이트 됩니다.

To do so you can:
먼저 깃허브에 접속하여 로그인을 합니다.
Make sure you login via GitHub (if you already have an account not connected to GitHub, you can connect it on your profile). 
GitHub을 통해 로그인했는지 확인하십시오 (이미 GitHub에 연결되지 않은 계정이 있으면 프로필에 연결할 수 있습니다).

If you are logged in already, log out first then login via GitHub again to make sure you grant us the required permissions.
이미 로그인 한 경우 먼저 로그 아웃 한 다음 GitHub을 통해 다시 로그인하여 필요한 권한을 부여했는지 확인하십시오.

Make sure the Packagist application has access to all the GitHub organizations you need to publish packages from.
Packagist 애플리케이션이 패키지를 게시하는 데 필요한 모든 GitHub 조직에 액세스 할 수 있는지 확인하십시오.

Check your package list to see if any has a warning about not being automatically synced.
패키지 목록을 확인하여 자동으로 동기화되지 않는다는 경고가 있는지 확인하십시오.

If you still need to setup sync on some packages, try triggering a manual account sync to have Packagist try to set up hooks on your account again. 
일부 패키지에서 동기화를 설정해야하는 경우 수동 계정 동기화를 실행하여 Packagist가 계정에서 후크를 다시 설정하도록하십시오.

Note that archived repositories can not be setup as they are readonly in GitHub's API.
보관 된 저장소는 GitHub의 API에서 읽기 전용이므로 설정할 수 없습니다.


https://www.youtube.com/watch?v=xStIvGNosVc


## Bitbucket Webhooks
To enable the Bitbucket web hook, go to your BitBucket repository, open the settings and select "Webhooks" in the menu. Add a new hook. You have to enter the Packagist endpoint, containing both your username and API token. Enter https://packagist.org/api/bitbucket?username=hojinlee&apiToken=API_TOKEN as URL. Save your changes and you're done.

## GitLab Service
To enable the GitLab service integration, go to your GitLab repository, open the Settings > Integrations page from the menu. Search for Packagist in the list of Project Services. Check the "Active" box, enter your packagist.org username and API token. Save your changes and you're done.

## Manual hook setup
If you do not use Bitbucket or GitHub there is a generic endpoint you can call manually from a git post-receive hook or similar. You have to do a POST request to https://packagist.org/api/update-package?username=hojinlee&apiToken=API_TOKEN with a request body looking like this: {"repository":{"url":"PACKAGIST_PACKAGE_URL"}}

You can do this using curl for example:
```php
curl -XPOST -H'content-type:application/json' 'https://packagist.org/api/update-package?username=hojinlee&apiToken=API_TOKEN' -d'{"repository":{"url":"PACKAGIST_PACKAGE_URL"}}'
```

## API Token
You can find your API token on your profile page.