<x-mail::message>
# Lead tư vấn mới từ AXIRO

Một khách hàng vừa gửi thông tin tư vấn từ website company.

<x-mail::panel>
**Họ và tên:** {{ $lead->full_name }}  
**Số điện thoại:** {{ $lead->phone }}  
**Email:** {{ $lead->email ?: 'Chưa cung cấp' }}  
**Công ty:** {{ $lead->company_name ?: 'Chưa cung cấp' }}  
**Chức danh:** {{ $lead->job_title ?: 'Chưa cung cấp' }}  
**Quy mô:** {{ $lead->company_size ?: 'Chưa cung cấp' }}  
**Nhu cầu quan tâm:** {{ $lead->interest }}
</x-mail::panel>

@if ($lead->message)
## Nội dung trao đổi

{{ $lead->message }}
@endif

## Thông tin nguồn

- Trang gửi form: {{ $lead->page_url ?: 'Không có' }}
- UTM source: {{ $lead->utm_source ?: '-' }}
- UTM medium: {{ $lead->utm_medium ?: '-' }}
- UTM campaign: {{ $lead->utm_campaign ?: '-' }}
- IP: {{ $lead->ip_address ?: '-' }}
- Thời gian: {{ $lead->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i:s') }}

Thanks,  
{{ config('app.name') }}
</x-mail::message>
