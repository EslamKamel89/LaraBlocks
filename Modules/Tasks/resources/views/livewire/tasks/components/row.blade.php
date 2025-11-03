<tr class="border-t">
    <td class="p-3">{{ $title }}</td>
    <td class="p-3">{{ $description }}</td>
    <td class="p-3">
        <div class="text-center text-sm">{{ $isDone ? '✅ completed' : '⏳ pending' }}</div>
    </td>
    <td class="p-3">{{ $updatedHuman }}</td>
</tr>