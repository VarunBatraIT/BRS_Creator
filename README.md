BRS_Creator
===========
Helps creating BRS without rewriting things
<br>
You can set variables in config.yml file
<br>
Following are sample of values:
```yaml
    cost_per_hour: 20
    currency: $
    working_hours_per_day: 9
    actual_working_hours_per_day: 5
    average_work_force: 2
    round_off: 1
    days_per_week: 5
    delay_in_percent: 10
```
Point at with we have MVP written in estimations.yml, that prior to that point, all the task will value up to MVP and number of hours for MVP to go out will be count till that point.

```yaml
  Import of first few questions/answers in database: 8
  Setting up live Server: 4
  Share test results in social networking website: 3
MVP:
Focus on Admin Panel:
  Bootstrapping admin panel: 16
  Admin can see test statistics: 10
```
