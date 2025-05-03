<tr>                   
                    <td class="px-4 py-2 border border-gray-300">
                        <input type="text" name="title[]" id="title" value="<?= old('title') ?>" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </td>               
                    <td class="px-4 py-2 border border-gray-300">
                        <input type="text" name="total_amount" id="total_amount" value="<?= old('total_amount') ?>" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <select name="type_id[]" id="type_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            <?php if (!empty($typeList)) { foreach ($typeList as $workflow): ?>
                            <option value="<?= $workflow['id'] ?>" <?= old('type_id') == $workflow['id'] ? 'selected' : '' ?>>
                                <?= $workflow['title'] ?>
                            </option>
                            <?php endforeach; } ?>
                        </select>
                    </td>               
                    <td class="px-4 py-2 border border-gray-300">
                        <select name="material_id[]" id="material_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Material</option>
                            <?php if (!empty($materialList)) { foreach ($materialList as $mat): ?>
                            <option value="<?= $mat['id'] ?>" <?= old('material_id') == $mat['id'] ? 'selected' : '' ?>>
                                <?= $mat['material'] ?>
                            </option>
                            <?php endforeach; } ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <select name="frame_id[]" id="frame_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Frame</option>
                            <?php if (!empty($frameList)) { foreach ($frameList as $frame): ?>
                            <option value="<?= $frame['id'] ?>" <?= old('frame_id') == $frame['id'] ? 'selected' : '' ?>>
                                <?= $frame['name'] ?>
                            </option>
                            <?php endforeach; } ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <select name="size_id[]" id="size_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Size</option>
                            <?php if (!empty($sizeList)) { foreach ($sizeList as $frame): ?>
                            <option value="<?= $frame['id'] ?>" <?= old('size_id') == $frame['id'] ? 'selected' : '' ?>>
                                <?= $frame['title'] ?>
                            </option>
                            <?php endforeach; } ?>
                        </select>
                    </td>
                    <td class="px-4 py-2 border border-gray-300">
                        <input type="number[]" name="quantity[]" id="quantity" value="<?= old('quantity') ?>" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </td>
                </tr>